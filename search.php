<?php
    session_start();
    if (count($_SESSION) === 0) {
        header("Location: login.php");
        exit;
    }
    require_once("db_config.php");
    $name = $_POST['dataName'];
    $sql = "SELECT * FROM users WHERE idUser != ".intval($_SESSION['idUser'])." AND (firstName  LIKE '%$name%' OR lastName LIKE '%$name%')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() != 0) {
        $row = $stmt->fetchAll();
        for ($i=0; $i < count($row); $i++) { 
            $element = '<a href="chat.php?data='.$row[$i]["idUser"].'&user='.$_SESSION['idUser'].'" data='.$row[$i]["idUser"].'>';
            $element = $element . '<div class="content">';
            $imgs = $row[$i]['image'] !== null ? $imgs=$row[$i]['image']: $imgs ='images/people.png' ;
            $element = $element . '<img src=" '. $imgs .'" alt="" width="50" height="50">';
            $element = $element . '<div class="details">';
            $element = $element . '<span id="name">'. ucfirst($row[$i]["firstName"]) . " " . ucfirst($row[$i]["lastName"]) .'</span>';
            $element = $element . '</div>';
            $element = $element . '</div>';
            $status = $row[$i]['status'] == 1 ? "online":"offline";
            $element = $element . '<div class="satuts '. $status .'"><i class="fa-solid fa-circle"></i></div>';
            $element = $element . '</a>';
            echo $element;
        }
    }else {
        echo 'No User Found Related To Your Search Term';
    }
    