<?php

define("DB_HOST","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","root");
define("DB_NAME","employees");

// create connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// checking connection
if($conn->connect_error){
    die("Connection failed!");
}

?>