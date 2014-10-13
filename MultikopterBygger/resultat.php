<?php
$host = "127.0.0.1";
$port = 3306;
$socket = "/tmp/mysql.sock";
$user = "user";
$password = "123";
$dbname = "kopterbygger";

$con=  mysqli_connect($host, $user, $password, $dbname, $port, $socket);

if (mysqli_connect_errno()) {
    echo "Failed to connect ot MySQL: " . mysqli_connect_errno();
}

$query = "SELECT PropellID";
$query .= "FROM Propeller";
$query .= "WHERE Prop_dia = 9";

$result = mysqli_query($con, "SELECT * FROM Propeller");

while($row = mysqli_fetch_array($result)) {
  echo "ID: " . $row['PropellID'] . " Navn: " . $row['Navn'] . " Diameter: " . $row['Prop_dia'];
  echo "<br>";
}

mysqli_close($con);
?>