<?php
session_start();
session_unset();
session_destroy();

// Change the header back to index.php page after destroying the session
header("Location: index.php");
exit();
