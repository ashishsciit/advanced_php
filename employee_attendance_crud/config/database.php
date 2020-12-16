<?php

define("DB_HOST","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","root");
define("DB_NAME","employees");

// create connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME); // mysqli object oriented

// checking connection
if($conn->connect_error){
    die("Connection failed!");
}

define("PDO_DSN","mysql:host=localhost; dbname=employees");
define("PDO_USERNAME","root");
define("PDO_PASSWORD","root");
try {
    $pdo_conn = new PDO(PDO_DSN, PDO_USERNAME, PDO_PASSWORD); // PDO Database Connection
    $pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // sets error mode to exception
    // echo "Connected";
}
catch(PDOException $e) {
    echo "PDO Database Connection Failed! due to " . $e->getMessage();

}

// $query = "SELECT * FROM `personal_details`";
// $result=$pdo_conn->query($query);
// if($result->rowCount()){
//     // foreach($result->fetchAll(PDO::FETCH_LAZY) as $row){
//     //     echo "<pre>";
//     //     print_r($row);
//     //     echo "</pre>";
//     // }
//     print_r($result->fetch(PDO::FETCH_LAZY));
// }

?>