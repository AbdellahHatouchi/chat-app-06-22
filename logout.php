<?php
    session_start();
    if (count($_SESSION) === 0) {
        header("Location: login.php");
        exit;
    }else {
        require_once("db_config.php");
        $sql = "UPDATE users SET status = 0 WHERE idUser =". $_SESSION['idUser'];
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        session_unset();
        session_destroy();
        unset($pdo);
        header("Location: login.php");
    }