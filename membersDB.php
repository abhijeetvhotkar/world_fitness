<?php
session_start();
require_once("db.php");

//when user clicks on add member button
if(isset($_POST)) {

//Escaping special charachters in the string first
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $origin = mysqli_real_escape_string($conn, $_POST['origin']);
        $createdDate = mysqli_real_escape_string($conn, $_POST['createdDate']);
        $memPhoneNum = mysqli_real_escape_string($conn, $_POST['memPhoneNum']);
        $calenderEvents = mysqli_real_escape_string($conn, $_POST['calenderEvents']);
        $recServiceOpt = mysqli_real_escape_string($conn, $_POST['recServiceOpt']);
        $payment = mysqli_real_escape_string($conn, $_POST['payment']);
        $balance = 100 - $payment;
        $purSessions = mysqli_real_escape_string($conn, $_POST['purSessions']);
        $remSessions = mysqli_real_escape_string($conn, $_POST['remSessions']);
        $alert = mysqli_real_escape_string($conn, $_POST['alert']);
        $agreementStatus = mysqli_real_escape_string($conn, $_POST['agreementStatus']);
        $applicationStatus = "";

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

        $sql = "INSERT INTO members(id_user, name, origin, created_date, mem_phone_number, calender_events, recurring_services, payments, balance, purchase_sessions, remaining_sessions, alert, agreement_status, application_status) VALUES ('$_SESSION[id_user]', '$name', '$origin', '$createdDate', '$memPhoneNum', '$calenderEvents', '$recServiceOpt', '$payment', '$balance', '$purSessions', '$remSessions', '$alert', '$agreementStatus', '$applicationStatus')";
        // SQL query to insert the values into members table

        // Set the session variable to true if the sql query executed and move the header back to members page
        if($conn->query($sql)===TRUE){
            $_SESSION['addMemberCompleted'] = true;
            header("Location: members.php");
            exit();
        } // If the query did not execute then stat on the same page
        else {
            $_SESSION['addMemberError'] = $conn->error;
            header("Location: add_new_member.php");
            exit();
        }

} else {
        header("Location: add_new_member.php");
        exit();

}
