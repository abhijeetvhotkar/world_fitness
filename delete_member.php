<?php
session_start();
require_once("db.php");

//when user clicks on delete link
if(isset($_POST)) {

    $sql = "DELETE FROM members WHERE id_member = '$_GET[id]' AND id_user = '$_SESSION[id_user]'";

    if($conn->query($sql)===TRUE){
        $_SESSION['memberDeleteSuccess'] = true;
        header("Location: members.php");
        exit();
    } else {
        echo "Error "  .  $sql  .  "<br>"  .  $conn->error;
    }

    $conn->close();

} else {
    header("Location: members.php");
    exit();

}
