<?php
include 'dbConnect.php';

	$q=$_REQUEST["q"];
	$_SESSION['ESCSelected'] = $q;
 mysqli_close($con);
?>