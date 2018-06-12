<?php
// Start session
  session_start();
  // Check if id_user is set, if set then set header to dashboard.php
  if(isset($_SESSION['id_user'])){
    header('location: dashboard.php');
  }
  // Connect to database
  require_once("db.php");
 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <!-- Load the Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Load the css stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>World Fitness</title>
  </head>
  <body>

    <div class="login-box">
      <img src="helpers/avatar.png" class="avatar">
      <h1>World Fitness</h1>
          <form method="post" action="check_login.php">
            <p>Username</p>
            <input type="text" id="e_mail" name="e_mail" placeholder="Enter Username" required="">
            <p>Password</p>
            <input type="password" id="password" name="password" placeholder="Enter Password" required="">
            <input type="submit" name="submit" value="Login">
            <input type="button" name="submit" value="Register" onclick="location.href='register.php';">

            <!-- If the registeration is succesful then display the success message -->
            <?php
            if(isset($_SESSION['registerCompleted'])){
            ?>
              <div>
              <p id="successMessage" class="text-center successMessage">You Have Registered Successfully!</p>
              </div>
            <?php
            unset($_SESSION['registerCompleted']);}
            ?>

            <!-- If there is an error while logging in, then display the invalid email/pass message -->
            <?php
            if(isset($_SESSION['loginError'])){
            ?>
            <div>
              <p class="text-center successMessage">Invalid Email/Password! Try Again!</p>
            </div>
            <?php
              unset($_SESSION['loginError']);}
            ?>
          </form>
    </div>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript">

        // Fade out animation function using jquery

        $(function(){
          $(".successMessage:visible").fadeOut(2000);
        });
        </script>
  </body>
</html>
