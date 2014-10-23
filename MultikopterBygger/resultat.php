<?php
include 'dbConnect.php';
?>

<?php
$con = $_SESSION['connection'];
$videoopptak = $_POST['videoopptak'];
$airtime = $_POST['airtime'];
$gps = $_POST['gps'];

$query = "SELECT SpesifikasjonID ";
$query .= "FROM spesifikasjoner ";
$query .= "WHERE Videoopptak='" . $videoopptak 
        . "' and Rekkevidde='" . $airtime . "' and GPS='" . $gps . "';";

$result = mysqli_query($con, $query);

while($row = mysqli_fetch_array($result)) {
    $queryResult = $row['SpesifikasjonID'];
}

$query2 = "SELECT Beskrivelse FROM oppskrift WHERE OppskriftID = " . $queryResult;

$result2 = mysqli_query($con, $query2);

while($row = mysqli_fetch_array($result2)) {
    echo "Beskrivelse: " . $row['Beskrivelse'];
    echo "<br>";
}

mysqli_close($con);
?>

