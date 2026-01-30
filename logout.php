<?php
    session_start();
    session_destroy();
    setcookie('email','',time()-1);
    header('location: index.php');
?>