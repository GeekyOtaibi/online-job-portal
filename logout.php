<?php

    session_start();
    
    if(isset($_SESSION['username']))
    {
        unset($_SESSION['username']);
        unset($_SESSION['type']);
        unset($_SESSION['name']);
        unset($_SESSION['id']);
        session_destroy();
        header('location:login.php');
    }

?>