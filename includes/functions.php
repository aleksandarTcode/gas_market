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
        global ${$input.'Err'}; // makes name for error variable, ex. if $input is first_name, it is first_nameErr
        ${$input.'Err'} = "Field is required";
    }  // check regular expression for input
    elseif (!preg_match($regEx, $_POST[$input])) {
        global ${$input.'Err'};
        ${$input.'Err'} = $msg;
        $_SESSION[$input] = $_POST[$input]; // makes session for form output when input is wrong
    }
    else {
        global $$input; // // makes name for variable
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

function insert_data(){
    global $conn;

    $date = date('Y-m-d H:i:s', strtotime($_POST['date'].date('H:i:s')));

    $country = $conn->real_escape_string($_POST['country']);
    $amount = $_SESSION['amount'] = $conn->real_escape_string($_POST['amount']);
    $price = $_SESSION['price'] = $conn->real_escape_string($_POST['price']);
    $date = $conn->real_escape_string($date);
    $_SESSION['date'] = $_POST['date'];

    $user_id = $conn->real_escape_string(get_user_id());


    $sql = "INSERT into gas (country, amount, price, date1, user_id) VALUES ('{$country}','{$amount}','{$price}','{$date}','{$user_id}')";

    if ($conn->query($sql) === TRUE) {
        set_message("New record created successfully");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}


function get_user_id()
{
    global $conn;

    $username = $_SESSION['username'];
    $sql = "SELECT id FROM users WHERE username='{$username}'";

    $result = $conn->query($sql);

    if ($result->num_rows !== 0) {
        $row = $result->fetch_assoc();
        return $row['id'];
    }
}

// country remain selected after form submit
function select_country_in_form($country){
    if (isset($_POST['country']) && $_POST['country']==$country)
        echo "selected";
}


function clear_fields(){
    $amount = $_SESSION['amount'] = "";
    $price = $_SESSION['price'] = "";
    $date = $_SESSION['date'] = "";
}


?>