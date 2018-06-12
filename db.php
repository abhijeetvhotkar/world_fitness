<?php
// Connection to the Database

$servername = "localhost";
$username = "root";
// For fresh installation of xampp keep the settings as it is
// If you change the password of the myphpadmin, then type the password in the password field.
// $password = "";
$password = "Password@123";
$db_name = "membership_management";

// Connect to database
$conn = new mysqli($servername, $username, $password, $db_name);

// Throw error if $servername, $username, $password is incorrect
if($conn->connect_error){
  die("Connection Failed: ". $conn->connect_error);
}
