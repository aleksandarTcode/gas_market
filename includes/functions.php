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
    $sql_username_check = "SELECT * FROM users WHERE username = '{$user}'";
    $result = $conn->query($sql_username_check);

    $sql_email_check = "SELECT * FROM users WHERE email = '{$email}'";
    $result2 = $conn->query($sql_email_check);

    if ($result->num_rows > 0) {
        global $userErr;
        $userErr = "Username is already taken, please choose another one!";
    } elseif($result2->num_rows > 0) {
        global $emailErr;
        $emailErr = "Email is already in use, please choose another one!";
    }
    else {

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
    $total_price = $amount * $price;
    $date = $conn->real_escape_string($date);
    $_SESSION['date'] = $_POST['date'];

    $user_id = $conn->real_escape_string(get_user_id());


    $sql = "INSERT into gas (country, amount, price, total_price,date1, user_id) VALUES ('{$country}','{$amount}','{$price}','{$total_price}','{$date}','{$user_id}')";

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

function show_all_unique_countries(){
    global $conn;

    $sql = "SELECT country, ROUND(AVG(price),3) as average FROM gas GROUP BY country ORDER BY average ASC";
    $result = $conn->query($sql);

    if ($result->num_rows !== 0) {

        $i=1;
        while ($row = $result->fetch_assoc()){

//            $average_gas_price = round(average_gas_price($row['country']),3);
            $table=<<<DELIMITER
                <tr>
                    <th scope="row">{$i}</th>
                    <td>{$row['country']}</td>
                    <td>{$row['average']}&#36;</td>
                    <td><input type="checkbox" name="countries[]" class="check" id="id{$i}" value="{$row['country']}"></td>
                    
                </tr>
DELIMITER;
            $i++;
            echo $table;

        }
    }

    $conn->close();
}


function average_gas_price($country)
{
    global $conn;
    $sql = "SELECT avg(price) as AveragePrice FROM gas WHERE country='{$country}'";
    $result = $conn->query($sql);

    if ($result->num_rows !== 0) {
        $row = $result->fetch_assoc();
        return $row['AveragePrice'];
    }

}



function num_rows($sql){
    global $conn;

    $result = $conn->query($sql);

    return $result->num_rows;

}


function show_all(){
    global $conn;

    $total_entries = num_rows("SELECT * FROM gas");
    $perPage = 2;

    if(isset($_GET['page'])){
        $page = preg_replace('/[^0-9]/','', $_GET['page']);
    }else{
        $page = 1;
    }

    $lastPage = ceil($total_entries / $perPage);

    if($page < 1){
        $page = 1;
    }elseif($page > $lastPage){
        $page = $lastPage;
    }

    $middleNumbers = '';
    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;

    if($page == 1){

        $middleNumbers.='<li class="page-item active"><a class="page-link">'.$page.'</a></li>';

        $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">'.$add1.'</a></li>';


    } elseif($page == $lastPage){

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';

        $middleNumbers.='<li class="page-item active"><a class="page-link">'.$page.'</a></li>';



    }elseif ($page > 2 && $page < ($lastPage -1)){
        $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub2.'">'.$sub2.'</a></li>';

        $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">'.$sub1.'</a></li>';

        $middleNumbers.='<li class="page-item active"><a class="page-link">'.$page.'</a></li>';

        $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">'.$add1.'</a></li>';

        $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'">'.$add2.'</a></li>';



    }elseif($page > 1 && $page < $lastPage){
        $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">'.$sub1.'</a></li>';

        $middleNumbers.='<li class="page-item active"><a class="page-link">'.$page.'</a></li>';

        $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">'.$add1.'</a></li>';

    }

    $limit = 'LIMIT ' . ($page-1)* $perPage . ',' . $perPage;



    $outputPagination = "";


    if ($page != 1){
        $prev = $page - 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'">Back</a></li>';
    }

    $outputPagination .= $middleNumbers;

    if ($page != $lastPage){
        $next = $page + 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'">Next</a></li>';
    }


    echo "<div class='text-center' style='clear: both'><ul class='pagination'>{$outputPagination}</ul></div>";


    $sql = "SELECT id,country, amount, price, total_price, date1 FROM gas ORDER BY date1 desc {$limit}";
    $result = $conn->query($sql);
    if ($result->num_rows !== 0) {
        while($row = $result->fetch_assoc()){

            $table=<<<DELIMITER
            <tr>
                    
                    <td>{$row['country']}</td>
                    <td>{$row['amount']} Mmbtu</td>
                    <td>{$row['price']} &#36;</td>
                    <td>{$row['total_price']} &#36;</td>
                    <td>{$row['date1']}</td>
                    <td>
                <a href="show.php?entry_id={$row['id']}"  class="btn btn-danger btn-block" name="register" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
                </tr>
DELIMITER;

            echo $table;

        }
    }
    $conn->close();
}

function delete_entry($table,$id){
    global $conn;
    $id = $conn->real_escape_string($id);
    $sql = "DELETE from {$table} WHERE id = '{$id}'";

    if ($conn->query($sql) !== TRUE) {
        echo "Error deleting record: " . $conn->error;
    }


}


function show_selected_countries_entries(){

    global $conn;

    $countries_from_checkbox_sessions = "'" . implode("','", $_SESSION['countries']) . "'";

    $sql = "SELECT id,country, amount, price, total_price, date1 FROM gas WHERE country IN({$countries_from_checkbox_sessions}) ORDER BY country";

    $result = $conn->query($sql);
    if ($result->num_rows !== 0) {
        $i=1;
        while($row = $result->fetch_assoc()){

            $table=<<<DELIMITER
            <tr>
                    <th scope="row">{$i}</th>
                    <td>{$row['country']}</td>
                    <td>{$row['amount']} Mmbtu</td>
                    <td>{$row['price']} &#36;</td>
                    <td>{$row['total_price']} &#36;</td>
                    <td>{$row['date1']}</td>
                    <td>
                <a href="country.php?entry_id={$row['id']}"  class="btn btn-danger btn-block" name="register" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
                </tr>
DELIMITER;
            $i++;
            echo $table;

        }
    }
    $conn->close();
}
?>