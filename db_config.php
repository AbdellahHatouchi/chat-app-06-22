<?php
    try {
        $pdo = new PDO("mysql: host=localhost; dbname=chatapp",'root','1973');
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $result = '';
    }catch (PDOException $e) {
        echo die("ERROR: Could not connect.");
    }

