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

if (mysqli_connect_errno()) {
    echo "Failed to connect ot MySQL: " . mysqli_connect_errno();
}
?>

<?php
$con = $_SESSION['connection'];
$videoopptak = $_POST['videoopptak'];
$airtime = $_POST['airtime'];
$gps = $_POST['gps'];

$query = "SELECT SpesifikasjonID";
$query .= "FROM Spesifikasjoner";
$query .= "WHERE Videoopptak=" . $videoopptak 
        . " Rekkevidde=" . $airtime . " GPS=" . $gps . ";";

$result = mysqli_query($con, $query);

$query2 = "SELECT * FROM oppskrift WHERE OppskriftID = " . 1;

$result2 = mysqli_query($con, $query2);

while($row = mysqli_fetch_array($result2)) {
    echo "Beskrivelse: " . $row['Beskrivelse'];
    echo "<br>";
}

mysqli_close($con);
?>

