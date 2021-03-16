<?php
require_once ("includes/config.php");

if(isset($_SESSION['username'])){
    header("Location: index.php");
}

$usernameErr = $passwordErr = "";
$username = $password = "";
$_SESSION['user'] = $_SESSION['password'] = "";


if (isset($_POST['login'])) {

    login_user();
}

include ("includes/login_form.php");
?>