<?php 
 require_once("../includes/connection.php"); 
 global $con;
mysqli_query($con,"TRUNCATE TABLE sessions");
session_start();
$SESSION = array();
session_destroy();

header("location: login.php");
?>
