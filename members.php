<?php
// Start a session
  session_start();
  // Check if the id_user in session is unset, if unset then go to index.php page
  if(!isset($_SESSION['id_user'])){
      header('location: index.php');
  }
  require_once("db.php");
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
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <title>World Fitness</title>
  </head>
  <body>
    <header>


      <!-- NAVIGATION BAR -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="dashboard.php">World Fitness</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">Dashboard<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="members.php">Members</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- BODY -->
    <div class="container">
      <!-- Show the success message for member added successfully -->
      <?php if(isset($_SESSION['addMemberCompleted'])) { ?>
      <div class="row">
        <div class="col-md-12 successMessage">
          <div class="alert alert-success">
            Member added Successfully!!
          </div>
        </div>
      </div>
      <?php unset($_SESSION['addMemberCompleted']); }?>

      <!-- Show the success message for the member updated successfully -->
      <?php if(isset($_SESSION['updateMemberCompleted'])) { ?>
      <div class="row">
        <div class="col-md-12 successMessage">
          <div class="alert alert-success">
            Member updated Successfully!!
          </div>
        </div>
      </div>
      <?php unset($_SESSION['updateMemberCompleted']); }?>
    </div>

    <!-- Show danger message for the amount paid by member is greater than the balance amount -->
    <div class="container">
      <?php if(isset($_SESSION['paymentError'])) { ?>
      <div class="row">
        <div class="col-md-12 dangerMessage">
          <div class="alert alert-danger">
            Payment cannot be more than balance!
          </div>
        </div>
      </div>
      <?php unset($_SESSION['paymentError']); }?>
    </div>

    <!-- Add member button -->
    <div class="addMember">
      <input type="button" name="addMember" value="Add Member" onclick="location.href='add_new_member.php'">
    </div>

    <div class="container">
      <div id="membersTable" class="row">
        <div class="col-md-18">
          <div class ="table-responsive">
            <!-- Table showing all the members -->
            <table id="myTable" class="table table-hover">
              <h2 class="text-center">MEMBERS</h2>
              <thead class="thead-dark">
                <th class="text-center">Name</th>
                <th class="text-center">Origin</th>
                <th class="text-center">Created Date</th>
                <th class="text-center">Contact number</th>
                <th class="text-center">Calender Events</th>
                <th class="text-center">Recurring Service</th>
                <th class="text-center">Balance</th>
                <th class="text-center">Sessions Remaining</th>
                <th class="text-center">Agreement Status</th>
                <th class="text-center">Alert</th>
                <th class="text-center">Application Status</th>
                <th class="text-center">Action</th>
              </thead>
              <tbody>
                <!-- Query to select all the members for the user logged in -->
                <?php
                  $sql = "SELECT * FROM members WHERE id_user = '$_SESSION[id_user]'";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0){
                      //output the data
                      while ($row = $result->fetch_assoc())
                      {
                   ?>
                  <tr>
                      <td class="text-center"><?php echo $row['name']; ?></td>
                      <td class="text-center"><?php echo $row['origin']; ?></td>
                      <td class="text-center"><?php echo $row['created_date']; ?></td>
                      <td class="text-center"><?php echo $row['mem_phone_number']; ?></td>
                      <td class="text-center"><?php echo $row['calender_events']; ?></td>
                      <td class="text-center"><?php echo $row['recurring_services']; ?></td>
                      <td class="text-center"><?php echo $row['balance']; ?></td>
                      <td class="text-center"><?php echo $row['remaining_sessions']; ?></td>
                      <td class="text-center"><?php echo $row['agreement_status']; ?></td>
                      <td class="text-center"><?php echo $row['alert']; ?></td>
                      <td class="text-center"><?php echo $row['application_status']; ?></td>
                      <td class="text-center"><a href="update_member.php?id=<?php echo $row['id_member']; ?>">Edit</a>
                      <a href="delete_member.php?id=<?php echo $row['id_member']; ?>">Delete</a>
                      </td>
                  </tr>
                  <?php
                      }
                  }
                      $conn->close();
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>



    <!-- FOOTER -->
    <footer class="page-footer sticky-bottom font-small bg-dark pt-1 mt-4">
      <!-- Copyright -->
      <div class="footer-copyright text-center py-2" style="color: white;">© 2018 Copyright: &nbsp
        <a href="dashboard.php">World Fitness</a>
      </div>
      <!-- Copyright -->
    </footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
    // Fade out message function in jquery
    $(function(){
      $(".successMessage:visible").fadeOut(2000);
    });
    // Fade out message function in jquery
    $(function(){
      $(".dangerMessage:visible").fadeOut(2000);
    });
    </script>
  </body>


</html>
