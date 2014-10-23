<?php
include 'dbConnect.php';
	$q=$_REQUEST["q"];
	$_SESSION['motorSelected'] = $q;
 mysqli_close($con);
?>