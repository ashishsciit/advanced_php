<?php
define("DB_HOST","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","root");
define("DB_NAME","trip");


$conn = mysqli_connect(DB_HOST, DB_USERNAME,DB_PASSWORD,DB_NAME);
if(!$conn){
    die("Database Connection Failed! due to " . mysqli_connect_error());
}
class Database {
    const DB_HOST = "localhost";
    const DB_USERNAME = "root";
    const DB_PASSWORD = "root";
    const DB_NAME = "trip";
    protected $conn = false;
    public $test = "succ";
    public function __construct(){
        $this->conn = mysqli_connect(self::DB_HOST, self::DB_USERNAME, self::DB_PASSWORD, self::DB_NAME);
        if($this->conn){
            return 1;
        }
        return 0;
    }

}

?>