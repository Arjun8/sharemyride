<?php
Session_start();
    session_destroy();
    setcookie("rememberme", "", time()-3600);
    header("location: index.php");
?>