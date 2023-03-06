<?php
    require_once('db_config.php');
    function createConversation() {
        require_once('db_config.php');
        $sql = "SELECT uniqueID FROM users";
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll();
        $row_count = $stmt->rowCount();
        if ($row_count >= 2){
            $sql = "INSERT INTO coversations(incomingMsgID,outgoingMesID) VALUES (?,?)";
            $stmt=$pdo->prepare($sql);
            for ($i=0; $i < $row_count - 1; $i++) { 
                $stmt->execute([$row[$i]['uniqueID'],$row[$row_count-1]['uniqueID']]);
            }
        }
        unset($pdo);
    }
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email =  $_POST['email'];
        $password = $_POST["password"];
        if (!(empty($fname) && empty($lname) && empty($email) && empty($password))){
            if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $sql = "SELECT email FROM users WHERE email = '$email'";
                $stmt=$pdo->prepare($sql);
                $stmt->execute();
                if ($stmt->rowCount()==0) {
                    $password = password_hash($password,PASSWORD_DEFAULT);
                    $uniqueID = rand(time(),10000000);
                    $sql = "INSERT INTO users(uniqueID,firstName,lastName,email,password) VALUES ($uniqueID,'$fname','$lname','$email','$password')";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    if ($_FILES['image']['name'] != '') {
                        $ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
                        move_uploaded_file($_FILES['image']['tmp_name'],'images/'.$uniqueID.'.'.$ext);
                        $sql = "UPDATE users SET image = 'images/$uniqueID.$ext' WHERE uniqueID = '$uniqueID'";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                    }
                    // createConversation();
                    $sql = "SELECT idUser FROM users ORDER BY idUser ASC";
                    $stmt=$pdo->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetchAll();
                    $row_count = $stmt->rowCount();
                    if ($row_count >= 2){
                        $sql = "INSERT INTO coversations(incomingMsgID,outgoingMesID) VALUES (?,?)";
                        $stmt=$pdo->prepare($sql);
                        for ($i=0; $i < $row_count - 1; $i++) { 
                            $stmt->execute([$row[$i]['idUser'],$row[$row_count-1]['idUser']]);
                        }
                    }
                    // create table chat 
                    $sql = "SELECT conversationID FROM coversations WHERE outgoingMesID =".$row[$row_count-1]['idUser'];
                    $stmt=$pdo->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetchAll();
                    $row_count = $stmt->rowCount();
                    for ($i=0; $i < $row_count; $i++) {
                        $sql = "CREATE TABLE message".$row[$i]['conversationID']."(messageID int NOT NULL AUTO_INCREMENT,
                        incomingMsgID int NOT NULL,
                        outgoingMesID int NOT NULL,
                        textMessage varchar(255) DEFAULT NULL,
                        sendingDate datetime DEFAULT CURRENT_TIMESTAMP,
                        PRIMARY KEY (messageID),
                        FOREIGN KEY (incomingMsgID) REFERENCES users (idUser),
                        FOREIGN KEY (outgoingMesID) REFERENCES users (idUser)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
                        $stmt=$pdo->prepare($sql); 
                        $stmt->execute();
                    }
                    // empty folder 
                    $files = glob('imageSignup/*'); // get all file names
                    foreach($files as $file){ // iterate files
                    if(is_file($file)) {
                        unlink($file); // delete file
                    }
                    }
                    unset($pdo);
                    echo die('successful');
                }else {
                    echo die("$email-This Email Already Exist !");
                } 
            }else {
                echo die("Email Incorrect !");
            }
        }else {
            echo die('All Input Field Are Requered !');
        }
    }else {
        header("Location: login.php");
        exit;
    }