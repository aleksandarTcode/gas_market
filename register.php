<?php
require_once ("includes/config.php");

$first_nameErr = $last_nameErr = $usernameErr = $emailErr =  $passwordErr = $confirm_passwordErr = $ageErr = "";
$first_name = $last_name = $username = $email = $phone = $password = $confirm_password = $age = "";
$_SESSION['first_name'] = $_SESSION['last_name'] = $_SESSION['username'] = $_SESSION['email'] = $_SESSION['password'] = $_SESSION['confirm_password'] = $_SESSION['age'] = "";


if (isset($_POST['register'])) {

    // First and last name check
    $text_input_regEx = "/^[a-zA-Z-' ]*$/";
    $text_input_msg = "Only letters and white space allowed";
    text_input('first_name',$text_input_regEx,$text_input_msg);
    text_input('last_name',$text_input_regEx,$text_input_msg);

    // Username check
    $username_regEx = "/^[a-zA-Z0-9]*$/";
    $username_msg = "Only letters and numbers allowed";
    text_input('username',$username_regEx,$username_msg);

    // Password check
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

    // Email check
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

    // Age check
    $age_regEx = "/^[1-9][0-9]{1,3}$/";
    $age_msg = 'Age must be number';
    text_input('age',$age_regEx,$age_msg);




    if($first_name && $last_name && $username && $email && $password && $confirm_password && $age){

        echo $first_name;
        echo "<br>";
        echo $last_name;
        echo "<br>";
        echo $username;
        echo "<br>";
        echo $email;
        echo "<br>";
        echo $password;
        echo "<br>";
        echo $confirm_password;
        echo "<br>";
        echo $age;
        echo "<br>";
        echo $hashed_password;

        echo "<br>";
        echo "<br>";



foreach ($_REQUEST as $key=>$value){
    echo $key." ".$value."<br>";

}

    }

}

include ("includes/register_form.php");
?>