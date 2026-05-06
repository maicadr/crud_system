<?php 

$host = "localhost";
$username = "root";
$pssword = "";
$db = "crudsystem";

$conn = mysqli_connect($host, $username, $password, $db);

if (!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

?>