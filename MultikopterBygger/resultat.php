<?php
$host = "localhost";
$user = "DEEBIT\nikla_000";
$password = "nDe6aj9y";
$dbname = "Kopterbygger";

$con=mysqli_connect($host, $user, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect ot MySQL: " . mysqli_connect_errno();
}

$query = "SELECT Propell_PID";
$query .= "FROM Propeller";
$query .= "WHERE Prop_dia = 9";

$result = mysqli_query($con, $query);

while($row = mysqli_fetch_array($result)) {
  echo $row['Propell_PID'] . " " . $row['Prop_dia'];
  echo "<br>";
}

mysqli_close($con);
?>