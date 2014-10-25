<?php

session_start();

$host = "127.0.0.1";
$port = 3306;
$socket = "/tmp/mysql.sock";
$user = "user";
$password = "123";
$dbname = "kopterbygger";

$con=  mysqli_connect($host, $user, $password, $dbname, $port, $socket);

$_SESSION['connection'] = $con;
	$q=$_REQUEST["q"];
	$_SESSION['batteriSelected'] = $q;
 mysqli_close($con);
 
?>