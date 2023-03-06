<?php
    session_start();
    if (count($_SESSION) === 0) {
        header("Location: login.php");
        exit;
    }
    $iduser = intval($_SESSION['idUser']);
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        require_once("db_config.php");
        $message = strval($_POST['message']) ;
        if (strlen($message) > 0) {
            $data = intval($_POST['data']) ;
            $sql = "INSERT INTO message".$_SESSION['conversationID']."(incomingMsgID,outgoingMesID,textMessage) VALUES ($data,$iduser,'$message')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            echo 'successful';
        }else {
            echo 'message empty';
        }
        
    }else {
        echo 'error message';
    }