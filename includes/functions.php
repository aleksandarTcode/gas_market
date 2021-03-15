<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//check input text and password fields
function text_input($input,$regEx,$msg){

    if (empty($_POST[$input])) {
        global ${$input.'Err'};
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





?>