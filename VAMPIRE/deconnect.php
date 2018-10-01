<?php
session_start();
$_SESSION = array();
setcookie('auth', "", time()-3600);
session_destroy();
header("Location: accueil.php");
?>