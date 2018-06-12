<?php
// Start session
session_start();
if(isset($_SESSION['id_user'])){
  header("Location: dashboard.php");
  exit();
}
 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>World Fitness</title>
  </head>
  <body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <div class="register-box">
      <img src="helpers/avatar.png" class="avatar">
      <h1>World Fitness</h1>
      <h2>Registration</h2>
      <!-- Registration Form -->
          <form method="post" action="register_user.php">
            <p>First Name</p>
            <input type="text" id="firstName" name="firstName" placeholder="Enter First Name" required="">
            <p>Last Name</p>
            <input type="text" id="lastName" name="lastName" placeholder="Enter Last Name" required="">
            <p>E-mail address</p>
            <input type="text" id="e_mail" name="e_mail" placeholder="Enter e-mail address" required="">
            <p>Phone number</p>
            <input type="text" maxlength="10" id="phoneNum" name="phoneNum" placeholder="Enter your Phone Number" required="">
            <p>Password</p>
            <input type="password" id="password" name="password" placeholder="Enter your Password" required="">
            <input type="submit" name="submit" value="Register">
            <!-- Check if the email already exists in the database -->
            <!-- Same email address cannot be used for different users while registeration -->
            <?php
            if(isset($_SESSION['registerError'])){
            ?>
            <div>
              <p class="text-center">E-mail address already exists! Choose a different E-mail!</p>
            </div>
            <?php
            unset($_SESSION['registerError']);}
             ?>
          </form>
    </div>

  </body>
</html>
