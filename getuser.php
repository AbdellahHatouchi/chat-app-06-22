<?php
    session_start();
    if (count($_SESSION) !== 0) {
        require_once("db_config.php");
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email != '$email'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }else {
        header("Location: login.php");
        exit;
    }

    if($stmt->rowCount() > 0) {
        $row = $stmt->fetchAll();
        for ($i=0; $i < count($row); $i++) { 
            $element = '<a href="chat.php?data='.$row[$i]["idUser"].'&user='.$_SESSION['idUser'].'" data='.$row[$i]["idUser"].'>';
            $element = $element . '<div class="content">';
            $imgs = $row[$i]['image'] !== null ? $imgs=$row[$i]['image']: $imgs ='images/people.png' ;
            $element = $element . '<img src=" '. $imgs .'" alt="" width="50" height="50">';
            $element = $element . '<div class="details">';
            $element = $element . '<span id="name">'. ucfirst($row[$i]["firstName"]) . " " . ucfirst($row[$i]["lastName"]) .'</span>';
            // $sql2 = "SELECT * FROM  WHERE email != '$email'";
            // $stmt2 = $pdo->prepare($sql2);
            $datauser = $row[$i]["idUser"];
            $user = $_SESSION['idUser'];
            $sql1 = "SELECT conversationID FROM coversations WHERE (incomingMsgID = $datauser AND outgoingMesID = $user) OR (incomingMsgID = $user AND outgoingMesID = $datauser)";
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->execute();
            if ($stmt1->rowCount() === 1) {
                $row1 = $stmt1->fetchAll();
                $_SESSION['conversationID'] = $row1[0]['conversationID'];
            }else {
                echo die('error conversation');
            }

            $sql2 = "SELECT * FROM message".$_SESSION['conversationID']." ORDER BY messageID DESC LIMIT 1";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->execute();
            $lastM = '';
            if ($stmt2->rowCount() == 1) {
                $row2 = $stmt2->fetchAll();
                $str = $row2[0]['textMessage'];
                if (strlen($str)>=28) {
                    $str = substr($str,0,25).'...';
                }
                $row2[0]['outgoingMesID'] == $user ? $you='You :': $you='';
                $lastM = $you.' '.$str;
            }else {
                $lastM = 'New User' ;
            }
            // $stmt2->execute();

            $element = $element . '<p>'.$lastM.'</p>';
            $element = $element . '</div>';
            $element = $element . '</div>';
            $status = $row[$i]['status'] == 1 ? "online":"offline";
            $element = $element . '<div class="satuts '. $status .'"><i class="fa-solid fa-circle"></i></div>';
            $element = $element . '</a>';
            echo $element;
        }
    }else {
        echo "<div id='datares'>No User Are Availabe To Chat</div>";
    }
