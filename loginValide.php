<?php
    session_start();
    require_once("db_config.php");
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
        if (!(empty($email) && empty($password))){
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() === 1) {
                $user = $stmt->fetch(); 
                if(password_verify($password,$user["password"])){
                    $_SESSION['idUser'] = $user['idUser'];
                    $_SESSION['uniqueID'] = $user['uniqueID'];
                    $_SESSION['fname'] = $user['firstName'];
                    $_SESSION['lname'] = $user['lastName'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['image'] = $user['image'];
                    $sql = "UPDATE users SET status = 1 WHERE email = '$email'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    unset($pdo);
                    echo die("successful");
                }else {
                    echo die('Incorrect Eamil Or Password');
                }
            }else {
                echo die('Incorrect Eamil Or Password');
            }
        }else {
            echo die('All Input Field Are Requered !');
        }
    }else {
        header("Location: login.php");
        exit;
    }