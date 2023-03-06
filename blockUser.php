<?php
    session_start();
    if (count($_SESSION) === 0) {
        header("Location: login.php");
        exit;
    }
    require_once("db_config.php");
    $user = intval($_SESSION['idUser']);
    $datauser = intval($_POST['data']);
    $info = $_POST['info'];
    $sql = "SELECT * FROM coversations WHERE incomingMsgID = $datauser AND outgoingMesID = $user OR incomingMsgID = $user AND outgoingMesID = $datauser";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() === 1) {
        $row = $stmt->fetchAll();
        // $tumpsql = "SELECT conversationID FROM coversations LIMIT 1";
        // $tumpstmt = $pdo->prepare($tumpsql);
        // $tumpstmt->execute();
        // $tumprow = $tumpstmt->fetchAll();
        // if ($row[0]['conversationID'] == $tumprow[0]['conversationID']) {
        //     $blockuser1 = $row[0]['blockincoming'];
        //     $blockuser2 = $row[0]['blockoutgoing'];
        //     $change = 'blockincoming';
        // } else {
            
        // }
        if ($row[0]['outgoingMesID'] == $user) {
            $blockuser1 = $row[0]['blockoutgoing'];
            $blockuser2 = $row[0]['blockincoming'];
            $change = 'blockoutgoing';
        }else {
            $blockuser1 = $row[0]['blockincoming'];
            $blockuser2 = $row[0]['blockoutgoing'];
            $change = 'blockincoming';
        }
        if ($info == 'getdata') {
            if ($blockuser1 == 0 && $blockuser2 == 0) {
                echo 'noblock';
            } else if ($blockuser1 == 1 && $blockuser2 == 0) {
                echo '10'; 
            }else if ($blockuser1 == 0 && $blockuser2 == 1) {
                echo '01';
            }else {
                echo 'block';
            }
        } else if ($info == 'changedata') {
            if ($blockuser1 == 0) {
                $sql = "UPDATE coversations SET $change = 1 WHERE incomingMsgID = $datauser AND outgoingMesID = $user OR incomingMsgID = $user AND outgoingMesID = $datauser";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                echo 'block';
            }else {
                $sql = "UPDATE coversations SET $change = 0 WHERE incomingMsgID = $datauser AND outgoingMesID = $user OR incomingMsgID = $user AND outgoingMesID = $datauser";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                echo 'unblock';
            }
        }else {
            echo 'error';
        }
        
        
        
        // $_SESSION['block'] = $row[0]['block'];
        // if ($info == 'getdata') {
        //     echo $_SESSION['block'];
        //     exit;
        // }elseif ($info == 'changedata') {
        //     if ($_SESSION['block'] == 0) {
        //         $sql = "UPDATE coversations SET block = 1 WHERE incomingMsgID = $datauser AND outgoingMesID = $user OR incomingMsgID = $user AND outgoingMesID = $datauser";
        //         $stmt = $pdo->prepare($sql);
        //         $stmt->execute();
        //         echo 1;
        //     }else {
        //         $sql = "UPDATE coversations SET block = 0 WHERE incomingMsgID = $datauser AND outgoingMesID = $user OR incomingMsgID = $user AND outgoingMesID = $datauser";
        //         $stmt = $pdo->prepare($sql);
        //         $stmt->execute();
        //         echo 0;
        //     }
        // }else {
        //     echo 'error';
        // }
        // echo $_SESSION['block'];
    }else {
        echo die('error');
    }

