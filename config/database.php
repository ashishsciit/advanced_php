<?php

define("DB_HOST","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","root");
define("DB_NAME","trip");

// create connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// checking connection
if($conn->connect_error){
    die("Connection failed!");
}else{
    echo "Connection Seccessful!";
    $query = "SELECT * FROM participants";
    $result = $conn->query($query); // Execute query
    print_r($result);
    echo $result->num_rows; // output number of rows in the result
    if($result->num_rows > 0) {
        // $row = $result->fetch_assoc(); // returns results row in associative array form
        // print_r($row);
        echo '<br>';
        while($row = $result->fetch_assoc()) {
            echo $row['id'] . ' ' . $row['name'] . ' ' . $row['email'] . '<br>';
        }
    }else{
        echo "0 records found!";
    }
}

?>