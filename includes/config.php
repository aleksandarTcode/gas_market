<?php

ob_start(); //for header() use
session_start();
//session_destroy();

date_default_timezone_set("Europe/Belgrade");

defined("DB_HOST") ? null : define("DB_HOST", "localhost");
defined("DB_USER") ? null : define("DB_USER", "root");
defined("DB_PASS") ? null : define("DB_PASS","");
defined("DB_NAME") ? null : define("DB_NAME", "south_stream");

$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);


require_once("functions.php");

conn_check();




?>