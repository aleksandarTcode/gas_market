<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function set_message($msg){
    if(!empty($msg)){
        $_SESSION['message'] = $msg;
    }else {
        $msg = "";
    }
}


function display_message(){
    if(isset ($_SESSION['message'])){
        echo  $_SESSION['message'];
        unset($_SESSION['message']);
    }
}


function confirm($result){
    global $conn;
    if (!$result) {
        die("QUERY FAILED " . $conn->connect_error);
    }
}

//check input text and password fields
function text_input($input,$regEx,$msg){

    if (empty($_POST[$input])) {
        global ${$input.'Err'}; // makes variable name, ex. if $input is first_name, it is first_nameErr
        ${$input.'Err'} = "Field is required";
    }  // check if name only contains letters and whitespace
    elseif (!preg_match($regEx, $_POST[$input])) {
        global ${$input.'Err'};
        ${$input.'Err'} = $msg;
        $_SESSION[$input] = $_POST[$input];
    }
    else {
        global $$input;
        $$input = test_input($_POST[$input]);
        $_SESSION[$input] = $$input;
    }
}

function conn_check(){
    global  $conn;
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}


function redirect($location){
    header("Location: $location");
}


function add_user()
{
    global $conn;
    global $first_name, $last_name, $user, $email, $hashed_password, $age;

    $first_name = $conn->real_escape_string($first_name);
    $last_name = $conn->real_escape_string($last_name);
    $user = $conn->real_escape_string($user);
    $email = $conn->real_escape_string($email);
    $hashed_password = $conn->real_escape_string($hashed_password);
    $age = $conn->real_escape_string($age);

    // checks if username already exists
    $sql_check = "SELECT * FROM users WHERE username = '{$user}'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        global $userErr;
        $userErr = "Username is already taken, please choose another one!";
    } else {

        $sql = "INSERT INTO users (username, password, email, first_name,	last_name, age) VALUES ('$user', '$hashed_password', '$email', '$first_name', '$last_name','$age')";


        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            redirect('thanks.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}


function login_user(){
    global $conn;
    $username = $conn->real_escape_string(test_input($_POST['username']));
    $password = $conn->real_escape_string(test_input($_POST['password']));

    $sql = "SELECT * FROM users WHERE username = '{$username}'";
    $result = $conn->query($sql);

    if ($result->num_rows !== 0) {
        $row = $result->fetch_assoc();
        if($row['username'] == $username && password_verify($password,$row['password'])){
            $_SESSION['username'] = $username; // session for login check

        redirect("index.php");
        }
        else {
            set_message("Your Password is wrong!");
            $_SESSION['user'] = $username; // session for form reenter after wrong entry
            $_SESSION['password'] = $password; // session for form reenter after wrong entry
        }

    }
    else {
        set_message("Your Username or Password is wrong!");
        $_SESSION['user'] = $username; // session for form reenter after wrong entry
        $_SESSION['password'] = $password; // session for form reenter after wrong entry
    }
    $conn->close();

}


?>