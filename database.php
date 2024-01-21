<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "phppractice";
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed due to : ". mysqli_connect_error());
}
?>