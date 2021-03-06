<?php
  session_start();
  if(!isset($_SESSION['id_user'])){
      header('location: members.php');
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

    <section>
      <div class="container container-fluid">
          <div class="row">
              <div class="col-md-12">
                <h2 class="text-center mt-2">UPDATE EXISTING MEMBER</h2>
                  <form class="form-group required" id="addMemberForm" method="post" action="update_memberDB.php">
                    <?php
                    $sql = "SELECT * FROM members WHERE id_member = '$_GET[id]' AND id_user = '$_SESSION[id_user]' ";
                    $result = $conn->query($sql);

                    if($result->num_rows > 0){
                      while($row = $result->fetch_assoc()){
                    ?>
                    <p class="control-label">Name</p>
                    <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" placeholder="Enter Name" required="">
                    <p class="control-label">Origin</p>
                    <input type="text" id="origin" name="origin" value="<?php echo $row['origin']; ?>" placeholder="Enter Origin" required="">
                    <p class="control-label">Created Date</p>
                    <input type="date" id="createdDate" name="createdDate" value="<?php echo $row['created_date']; ?>" placeholder="To do Calender" required="">
                    <p class="control-label">Phone number</p>
                    <input type="text" maxlength="10" id="memPhoneNum" name="memPhoneNum" value="<?php echo $row['mem_phone_number']; ?>" placeholder="999-999-9999" required="">
                    <p class="control-label">Calender Events</p>
                    <input type="date" id="calenderEvents" name="calenderEvents" value="<?php echo $row['calender_events']; ?>" required="">
                    <p class="control-label">Recurring Service Option</p>
                    <select class="control-label" id="recServiceOpt" name="recServiceOpt" value="<?php echo $row['recurring_services']; ?>" required="" style="margin-top: 10px;">
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                    <!-- <input type="" id="recServiceOptIn" name="recServiceOptIn" placeholder="To DO" required=""> -->
                    <p class="control-label">Ammount Paid in $</p>
                    <input type="text" id="payment" name="payment" value="<?php echo $row['payments']; ?>" placeholder="Enter Paid ammount" required="">
                    <p class="control-label">Purchase Sessions</p>
                    <input type="text" id="purSessions" name="purSessions" value="<?php echo $row['purchase_sessions']; ?>" placeholder="Enter Sessions purchase quantity" required="">
                    <p class="control-label">Remaining Sessions</p>
                    <input type="text" id="remSessions" name="remSessions" value="<?php echo $row['remaining_sessions']; ?>" placeholder="Enter Sessions quantity" required="">
                    <p class="control-label">Agreement Status</p>
                    <select class="control-label" id="agreementStatus" name="agreementStatus" value="<?php echo $row['agreement_status']; ?>" required="" style="margin-top: 10px;">
                      <option value="Good">Good</option>
                      <option value="Past Due">Past Due</option>
                      <option value="Suspended">Suspended</option>
                      <option value="Inactive">Inactive</option>
                      <option value="Collections">Collections</option>
                    </select><br>
                    <p class="control-label">Alert</p>
                    <select class="control-label" id="alert" name="alert" value="<?php echo $row['alert']; ?>" required="" style="margin-top: 10px;">
                      <option value="On Going">On Going</option>
                      <option value="Canceled">Canceled</option>
                      <option value="Expired">Expired</option>
                    </select><br>
                    <input type="hidden" name="target_id" value="<?php echo $row['id_member']; ?>">
                    <input id="updateMember" type="submit" name="submit" value="Update Member">
                    <?php }
                    } ?>
                    </form>
                </div>
              </div>
            </div>
    </section>


    <!-- FOOTER -->
    <footer class="page-footer  font-small bg-dark pt-1 mt-4">
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

    </script>
  </body>


</html>
