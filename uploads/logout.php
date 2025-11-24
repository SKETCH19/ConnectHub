<?php
require_once 'includes/config.php';
require_once 'includes/functions.php'; 
require_once 'includes/auth.php'; 


session_destroy();
header("Location: login.php");
exit;
?>