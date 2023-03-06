<?php
try {
    session_start();
    if (count($_SESSION) !== 0) {
        require_once("db_config.php");
    }else {
        header("Location: login.php");
        exit;
    }
    $user = intval($_SESSION['idUser']);
    $datauser = intval($_POST['data']);
    $sql = "SELECT conversationID FROM coversations WHERE incomingMsgID = $datauser AND outgoingMesID = $user OR incomingMsgID = $user AND outgoingMesID = $datauser";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() === 1) {
        $row = $stmt->fetchAll();
        $_SESSION['conversationID'] = $row[0]['conversationID'];
    }else {
        echo die('error');
    }
    

    $sql = "SELECT * FROM message".$_SESSION['conversationID']."";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() != 0) {
        $row = $stmt->fetchAll();
        for ($i=0; $i < $stmt->rowCount() ; $i++) {
            $mesg = "";
            if ($i == 0 ) {
                $mesg = "<div class='datestamp'>".date("M d Y",strtotime($row[$i]['sendingDate']))."</div>";
            } else{
                [$y,$m,$d] = explode("-",date("Y-m-d",strtotime($row[$i]['sendingDate'])));
                [$py,$pm,$pd] = explode("-",date("Y-m-d",strtotime($row[$i-1]['sendingDate'])));
                if ($d!=$pd||$m!=$pm||$y!=$py) {
                    $mesg = "<div class='datestamp'>".date("M d Y",strtotime($row[$i]['sendingDate']))."</div>";
                }
            }
            
            if ($row[$i]['outgoingMesID'] == $_SESSION['idUser']) {
                $mesg = $mesg .'<div class="chat outgoing"><div class="details">';
                $mesg = $mesg  .  '<p>'.$row[$i]['textMessage'].'</p><span class="date">'.date("h:i a",strtotime($row[$i]['sendingDate'])).'</span></div></div>';
            }else{
                $mesg = $mesg . '<div class="chat incoming">';
                $mesg = $mesg .'<img src="'.$_SESSION['imageUser'].'" alt="" width="40" height="40">';
                $mesg = $mesg . '<div class="details">';
                $mesg = $mesg . '<p>'.$row[$i]['textMessage'].'</p><span class="date">'.date("h:i a",strtotime($row[$i]['sendingDate'])).'</span></div></div>';
            }
            echo $mesg;
        }
    }

    
} catch (\Throwable $th) {
    $th->getMessage();
}
