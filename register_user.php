<?php
session_start();
require_once("db.php");

//when user clicks on register button
if(isset($_POST)) {

//Escaping special charachters in the string first
        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
        $e_mail = mysqli_real_escape_string($conn, $_POST['e_mail']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $phoneNum = mysqli_real_escape_string($conn, $_POST['phoneNum']);

        //Encrypting password
        $password = base64_encode(strrev(md5($password)));

        // Insertion query to insert credentials of the user in the users table
        $sql = "INSERT INTO users(first_name, last_name, e_mail, password, phone_num) VALUES ('$firstName', '$lastName', '$e_mail', '$password', '$phoneNum')";

        if($conn->query($sql)===TRUE){
            $_SESSION['registerCompleted'] = true;
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['registerError'] = $conn->error;
            header("Location: register.php");
            exit();
        }

} else {
        header("Location: register.php");
        exit();

}
