<?php
include 'dbConnect.php';

$query = 'CALL compID(' . $_GET['c'] . ')';
$row = mysqli_fetch_array(mysqli_query($con, $query));

$_SESSION['MotorID'] = $row['MotorID'];
$_SESSION['PropellID'] = $row['PropellID'];
$_SESSION['BatteriID'] = $row['BatteriID'];
$_SESSION['KontrollbrettID'] = $row['KontrollbrettID'];
$_SESSION['ESCID'] = $row['ESCID'];

header('Location: resultat.php');