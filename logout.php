<?php
session_start();
unset($_SESSION['ROLE']);
unset($_SESSION['USER_NAME']);
unset($_SESSION['USER_ID']);
header('location:login.php');
die();
?>