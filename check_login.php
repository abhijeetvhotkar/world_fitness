<?php
session_start();
require_once("db.php");

//when user clicks on login button
if(isset($_POST)){

//    Escaping the special characters
    $e_mail = mysqli_real_escape_string($conn, $_POST['e_mail']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //encrypt password
    $password = base64_encode(strrev(md5($password)));

    $sql = "SELECT id_user, first_name, last_name, e_mail FROM users WHERE e_mail = '$e_mail' AND password = '$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        //output the data
        while ($row = $result->fetch_assoc()){
            $_SESSION['e_mail'] = $row['e_mail'];
            $_SESSION['id_user'] = $row['id_user'];
            header("Location: dashboard.php");
            exit();
        }
    } else {
        $_SESSION['loginError'] = $conn->error;
        header("Location: index.php");
        exit();
    }

}  else {
    //redirect the user back to the login page
    header("Location: index.php");
    exit();
  }
