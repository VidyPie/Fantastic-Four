<?php
session_start();

$host = "127.0.0.1";
$port = 3306;
$socket = "/tmp/mysql.sock";
$user = "user";
$password = "123";
$dbname = "kopterbygger";

$con = mysqli_connect($host, $user, $password, $dbname, $port, $socket);

$_SESSION['connection'] = $con;

if (mysqli_connect_errno()) {
    echo "Failed to connect ot MySQL: " . mysqli_connect_errno();
}
?>
<!DOCTYPE html>
<!--
Fantastic Four
-->
<html>
    <head>
        <title>
            Kopterbygger
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">

    </head>
    <body>
        <div id="banner">
            <a href="index.html"><img class="banner" src="main_styling/banner.png" alt ="Kopterbygger"></a>
            <img class="extension" src="main_styling/bannerext.png" alt="graybox">
        </div>
        <div id="wrapper">
            <div id="content">
                Velg verdier som skal legges inn for motoren<br>
                <form name="motorAddForm" method="POST">
                    <input min="0" type="number" name="kVInput" placeholder="kV"><br>
                    <input min="0" type="number" name="ampInput" placeholder="Amps"><br>
                    <input min="0" type="number" name="prisInput" placeholder="Pris"><br>
                    <input min="0" type="number" name="prop_diaInput" placeholder="Propell diameter"><br>
                    <input min="0" type="number" name="prop_vinInput" placeholder="Propell vinkel"><br>
                    <input min="0" type="number" name="CE_maxInput" placeholder="Lipocell max"><br>
                    <input min="0" type="number" name="CE_minInput" placeholder="Lipocell min"><br>
                    <input type="text" name="navnInput" placeholder="Navn" size="50"><br>
                    <input type="submit" name="submit">
                </form>
                <h1>Redundant! Not in operation!</h1>
                <?php
                if (isset($_POST['submit'])) {
                    $con = $_SESSION['connection'];

                    $kvInput = $_POST['kVInput'];
                    $ampInput = $_POST['ampInput'];
                    $prisInput = $_POST['prisInput'];
                    $prop_dia = $_POST['prop_diaInput'];
                    $prop_vin = $_POST['prop_vinInput'];
                    $CE_max = $_POST['CE_maxInput'];
                    $CE_min = $_POST['CE_minInput'];
                    $navn = $_POST['navnInput'];

                    $Query = "SELECT MotorID FROM motor ORDER BY MotorID DESC LIMIT 1";
                    $result = mysqli_query($con, $Query);
                    while ($row = mysqli_fetch_array($result)) {
                        $lMotorID = $row['MotorID'];
                    }
                    $nMotorID = $lMotorID + 1;

                    echo $nMotorID . '<br>' . $kvInput . '<br>' . $ampInput . '<br>' . $prisInput . '<br>' . $prop_dia . '<br>' . $prop_vin . '<br>' . $CE_max . '<br>' . $CE_min . '<br>' . $navn;


//                    $query = "INSERT INTO `motor`(`MotorID`, `kV`, `Amps`, `Pris`, `Prop_dia`, `Prop_vin`, `CE_MAX`, `CE_MIN`, `Navn`) VALUES (,$kvInput,$ampInput,$prisInput,$prop_dia,$prop_vin,$CE_max,$CE_min,$navn)";
                }
                ?>
            </div>
        </div>
    </body>
</html>

