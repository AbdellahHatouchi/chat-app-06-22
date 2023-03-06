<?php
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        if ($_FILES['image']['name'] != '') {
            $ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
            $name = rand(time(),100000);
            move_uploaded_file($_FILES['image']['tmp_name'],'imageSignup/'.$name.'.'.$ext);
            echo 'imageSignup/'.$name.'.'.$ext;
        }else {
            echo 'error';
        }
    }else {
        header("Location: login.php");
        exit;
    }
    