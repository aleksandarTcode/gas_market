<?php
require_once ("includes/config.php");

if(isset($_SESSION['username'])){
    header("Location: index.php");
}


$first_nameErr = $last_nameErr = $userErr = $emailErr =  $passwordErr = $confirm_passwordErr = $ageErr = "";
$first_name = $last_name = $user = $email = $phone = $password = $confirm_password = $age = "";
$_SESSION['first_name'] = $_SESSION['last_name'] = $_SESSION['user'] = $_SESSION['email'] = $_SESSION['password'] = $_SESSION['confirm_password'] = $_SESSION['age'] = "";


if (isset($_POST['register'])) {

    // First and last name check and set
    $text_input_regEx = "/^[a-zA-Z-' ]*$/";
    $text_input_msg = "Only letters and white space allowed";
    text_input('first_name',$text_input_regEx,$text_input_msg);
    text_input('last_name',$text_input_regEx,$text_input_msg);

    // Username check an set
    $user_regEx = "/^[a-zA-Z0-9]*$/";
    $user_msg = "Only letters and numbers allowed";
    text_input('user',$user_regEx,$user_msg);

    // Password check and set
    $password_regEx = "/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/";
    $password_msg = "Password must contain 8-20 characters of at least one lowercase, uppercase, number and special character. Allowed characters are letters, numbers and special characters @#-_$%^&+=§!?";
    text_input('password',$password_regEx,$password_msg);

    // Check are confirmed password is the same
    if (empty($_POST["confirm_password"])) {
        $confirm_passwordErr = "Please confirm password";
    } elseif (strcmp($password,$_POST["confirm_password"])!==0){
        $confirm_passwordErr = "Password is not confirmed, enter the same password!";
        $_SESSION['confirm_password'] = $_POST["confirm_password"];
    }else {
        $confirm_password = test_input($_POST["confirm_password"]);
        $_SESSION['confirm_password'] = $confirm_password;
        $hashed_password = password_hash($confirm_password, PASSWORD_DEFAULT);

    }

    // Email check and set
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    }
       // Check if e-mail address is well-formed
    elseif (!filter_var(test_input($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $_SESSION['email'] = $_POST["email"];
    }
    else {
        $email = test_input($_POST["email"]);
        $_SESSION['email'] = $email;
    }

    // Age check and set
    $age_regEx = "/^[1-9][0-9]{1,3}$/";
    $age_msg = 'Age must be a number';
    text_input('age',$age_regEx,$age_msg);


    if($first_name && $last_name && $user && $email && $password && $confirm_password && $age){

        add_user();

    }
}

include ("includes/register_form.php");


?>