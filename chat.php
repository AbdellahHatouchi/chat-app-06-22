<?php
    session_start();
    if (count($_SESSION) !== 0) {
        require_once("db_config.php");
    }else {
        header("Location: login.php");
        exit;
    }
    $datauser = intval( $_GET['data']); 
    $user = intval($_GET['user']);
    $sql = "SELECT * FROM users WHERE idUser = ".$datauser."";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetchAll();
        $iduser = $row[0]['idUser'];
        $fname = $row[0]['firstName'];
        $lname = $row[0]['lastName'];
        $status = $row[0]['status'];
        $status == 1 ? $status = 'Online' : $status = 'Offline';
        $image = $row[0]['image'];  
        // $sql = "SELECT conversationID FROM coversations WHERE incomingMsgID = $datauser AND outgoingMesID = $user";
        // $stmt = $pdo->prepare($sql);
        // $stmt->execute();
        // if ($stmt->rowCount() === 1) {
        //     $row = $stmt->fetchAll();
        //     $_SESSION['conversationID'] = $row[0]['conversationID'];
        //     $sql = "SELECT * FROM message".$_SESSION['conversationID']."";
        //     $stmt = $pdo->prepare($sql);
        //     $stmt->execute();
        // }else {
        //     echo 'error';
        //     exit;
        // }
    }else {
        echo 'errorr';
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<?php
    require('header.php')
?>

<body>
    <div class="wrapper" style="width:400px;">
        <section class="chat" id="chatSection">
            <header>
                <a href="main.php"><i class="fa-solid fa-arrow-left"></i></a>
                <div class="content" id="contentid" data=<?php echo $iduser?>>
                    <img src="<?php $image !== null ? $img=$image: $img ='images/people.png' ;$_SESSION['imageUser'] = $img;echo $img;?>" alt="" width="50" height="50">
                    <div class="details">
                        <span><?php echo ucfirst($fname) . " " . ucfirst($lname) ?></span>
                        <p><?php echo $status?></p>
                    </div>
                </div>
                <button id="btn-setting"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="setting" id="setting">
                    <li class="item" id="item1"><i class="fa-solid fa-icons"></i> Change Emoji</li>
                    <li class="item"><i class="fa-solid fa-trash"></i> Delete Conversation</li>
                    <li class="item" id="block"><i class="fa-solid fa-ban"></i> Block</li>
                </ul>
            </header>
            <div class="chat-box" id="chat-box"> 
                <div class="spinner">
                    <span class="border-spinner"></span>
                </div>
                <?php
                    // if ($stmt->rowCount() != 0) {
                    //     $row = $stmt->fetchAll();
                    //     for ($i=0; $i < $stmt->rowCount() ; $i++) { 
                    //         if ($row[$i]['outgoingMesID'] == $user) {
                    //             $mesg = '<div class="chat outgoing"><div class="details" data='.$row[$i]['sendingDate'].'>';
                    //             $mesg = $mesg  .  '<p>'.$row[$i]['textMessage'].'</p></div></div>';
                    //         }else{
                    //             $mesg = '<div class="chat incoming">';
                    //             $image !== null ? $img=$image: $img ='images/people.png' ;
                    //             $_SESSION['imageUser'] = $img;
                    //             $mesg = $mesg .'<img src="'.$img.'" alt="" width="40" height="40">';
                    //             $mesg = $mesg . '<div class="details">';
                    //             $mesg = $mesg . '<p>'.$row[$i]['textMessage'].'</p></div></div>';
                    //         }
                    //         echo $mesg;
                    //     }
                    // }else {
                    //     echo 'Nething Message';
                    // }
                    
                ?>
                <!-- <div class="chat outgoing">
                    <div class="details">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="image/people.png" alt="" width="40" height="40">
                    <div class="details">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div> -->
            </div>
            <form id="myform" class="message">
                <textarea name="message" id="message" cols="30" rows="1" placeholder="Enter your message ..."></textarea>
                <!-- <input type="text" placeholder="Enter your message ..."> -->
                <button id="submit"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </section>
    </div>
    <script src="javaScript/chat.js"></script>
    <script src="javaScript/getMsg.js"></script>
    <script>
        $("#message").emojioneArea({
            pickerPosition : 'top right'
        })
    </script>
    
</body>

</html>