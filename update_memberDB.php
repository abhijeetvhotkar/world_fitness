  <?php
 session_start();
 require_once("db.php");

 //when user clicks on edit link
 if(isset($_POST)) {

 //Escaping special charachters in the string first

         $name = mysqli_real_escape_string($conn, $_POST['name']);
         $origin = mysqli_real_escape_string($conn, $_POST['origin']);
         $createdDate = mysqli_real_escape_string($conn, $_POST['createdDate']);
         $memPhoneNum = mysqli_real_escape_string($conn, $_POST['memPhoneNum']);
         $calenderEvents = mysqli_real_escape_string($conn, $_POST['calenderEvents']);
         $recServiceOpt = mysqli_real_escape_string($conn, $_POST['recServiceOpt']);
         $payment = mysqli_real_escape_string($conn, $_POST['payment']);
         $purSessions = mysqli_real_escape_string($conn, $_POST['purSessions']);
         $remSessions = mysqli_real_escape_string($conn, $_POST['remSessions']);
         $member_id = $_POST['target_id'];
         // Select the balance field fromt he members table using following query
         $balance_select_sql = "SELECT balance FROM members WHERE id_member = $member_id;";
         $result = mysqli_query($conn, $balance_select_sql);

         if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                 $balance = $row["balance"];
             } // Check if payment is greater than the balance, if yes then set a session variable paymentError and move the header to the members.php page
             if($payment > $balance) {
               $_SESSION['paymentError'] = true;
               header("Location: members.php");
               exit();
             } //Subtract the payment from balance if paid amount is less than or equal to balance
             else {
             $balance = $balance - $payment;
           }
          }

        $alert = mysqli_real_escape_string($conn, $_POST['alert']);
        $agreementStatus = mysqli_real_escape_string($conn, $_POST['agreementStatus']);
        // Retrieve Application Status from the members table
        $application_status_select_sql = "SELECT application_status FROM members WHERE id_member = $member_id;";
        $result1 = mysqli_query($conn, $application_status_select_sql);
        if ($result1->num_rows > 0) {
            while($row = $result1->fetch_assoc()) {
                $applicationStatus = $row["application_status"];
            }
          }

        // Set the application status using the agreement status, balance, alert, purchase sessions, and remaining sessions
        if ($agreementStatus == "Inactive" && $alert == 'Canceled') {
            $applicationStatus = "Canceled Customer";
        } elseif ($agreementStatus == "Inactive" && $alert == 'Expired') {
          $applicationStatus = "Expired Customer";
        } elseif ($agreementStatus == "Collections") {
          $applicationStatus = "Collections Customer";
        } elseif ($balance >= 0 AND ($agreementStatus == "Good") AND $remSessions >= 1 AND $purSessions == 1) {
         $applicationStatus = "Renewal Opportunity";
       } elseif ($balance >= 0 AND ($agreementStatus == "Good") AND $purSessions == 1 AND $remSessions >= 0) {
          $applicationStatus = "Drop In";
        } elseif ($balance == 0 AND ($agreementStatus == "Good" AND $alert == "On Going")) {
          $applicationStatus = "Active";
        } elseif ($balance > 0 && $agreementStatus == "Past Due") {
          $applicationStatus = "Deliquent";
        } elseif ($agreementStatus == "Suspended") {
          $applicationStatus = "Active Customer - Suspended";
        }

         $sql = "UPDATE members SET name = '$name', origin = '$origin', created_date = '$createdDate', mem_phone_number = '$memPhoneNum', calender_events = '$calenderEvents', recurring_services ='$recServiceOpt', payments = '$payment', balance = '$balance', remaining_sessions = '$remSessions', alert = '$alert', agreement_status = '$agreementStatus', application_status = '$applicationStatus' WHERE id_member = '$_POST[target_id]' AND id_user = '$_SESSION[id_user]'";
        // SQL query to update the values into members table

         // Set the session variable to true if the sql query executed and move the header back to members page
         if($conn->query($sql)===TRUE){
             $_SESSION['updateMemberCompleted'] = true;
             header("Location: members.php");
             exit();
         } //If the query did not execute then stat on the same page
          else {
             echo "Error ". $sql . "<br>" . $conn->error;
         }
         $conn->close();
 } else {
         header("Location: update_member.php");
         exit();
 }
