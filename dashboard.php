<?php
  // Start a session
  session_start();
  // Check if the id_user in session is unset, if unset then go to index.php page
  if(!isset($_SESSION['id_user'])){
      header('location: index.php');
  }
  require_once("db.php");
  // Query to get the application status from the database -> table "members"
  $query = "SELECT application_status, count(*) as number FROM members WHERE id_user = '$_SESSION[id_user]' GROUP BY application_status";
  // Execute the query
  $resultvar = mysqli_query($conn, $query);
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.arrayToDataTable([
        ['Application status', 'Number'],
        <?php
        while ($row = mysqli_fetch_array($resultvar)) {
          echo "['".$row["application_status"]."', ".$row["number"]."], ";
        }
         ?>
         ]);
         // Set chart options
         var options = {
           title: 'Application Status of members',
           'width': 640,
           'height': 480,
           'is3D': true
         };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
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
            <li class="nav-item active">
              <a class="nav-link" href="dashboard.php">Dashboard<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
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
    <!-- PIE CHART -->
    <div class="container">
      <div class="row">
        <div class="col-xs-6" style="margin: auto; width: 50%; padding: 10px;">
          <div id="chart_div"></div>
        </div>
        <div class="col-xs-6 col-md-12">
            <div id="membersTable">
                <div class ="table-responsive">
                  <!-- Table showing the important fields of the members -->
                  <table id="myTable" class="table table-hover">
                    <thead class="thead-dark">
                      <th class="text-center">Name</th>
                      <th class="text-center">Origin</th>
                      <th class="text-center">Contact number</th>
                      <th class="text-center">Application Status</th>
                    </thead>
                    <tbody>
                      <?php
                      // Select all rows from the members table
                        $sql = "SELECT * FROM members WHERE id_user = '$_SESSION[id_user]'";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            //output the data
                            while ($row = $result->fetch_assoc())
                            {
                         ?>
                        <tr>
                          <!-- Show only the required rows from the database -->
                            <td class="text-center"><?php echo $row['name']; ?></td>
                            <td class="text-center"><?php echo $row['origin']; ?></td>
                            <td class="text-center"><?php echo $row['mem_phone_number']; ?></td>
                            <td class="text-center"><?php echo $row['application_status']; ?></td>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>


</html>
