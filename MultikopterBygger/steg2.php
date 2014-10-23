<?php
session_start();

$host = "localhost";
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
            <a href=index.html>
                <img class="banner" src="main_styling/banner.png" alt ="Kopterbygger">
            </a>
            <a href=index.html>
                <img class="extension" src="main_styling/bannerext.png" alt="graybox">
            </a>
        </div>
        <div id="wrapper">
            <div id="content">
                <?php
                $videoopptak = $_POST['videoopptak'];
                $airtime = $_POST['airtime'];
                $gps = $_POST['gps'];
                $specquery = "SELECT `SpesifikasjonID` FROM `spesifikasjoner` WHERE `Rekkevidde` = '"
                        . $airtime . "' AND `Videoopptak` = '" . $videoopptak . "' AND `GPS` = '" . $gps . "';";
                $specresult = mysqli_query($con, $specquery);
                $srow = mysqli_fetch_array($specresult);
                $specID = $srow['SpesifikasjonID'];

                echo ' <div id="left_box"><b>Forslag 1</b> <br><br>';

                $query = 'SELECT o.Beskrivelse, m.Navn AS motor, b.*, esc.Navn AS esc, kon.Navn AS kbrett, p.*  '
                        . 'FROM spesifikasjoner AS s, oppskrift AS o, komponenter AS kom, motor AS m, batteri AS b, esc, kontrollbrett AS kon, propeller AS p '
                        . 'WHERE s.SpesifikasjonID = o.SpesifikasjonID AND o.KomponenterID = kom.KomponenterID '
                        . 'AND kom.MotorID = m.MotorID AND kom.BatteriID = b.BatteriID AND kom.ESCID = esc.ESCID '
                        . 'AND kom.KontrollbrettID = kon.KontrollbrettID AND kom.PropellID = p.PropellID AND s.SpesifikasjonID = ' . $specID;
                $result = mysqli_query($con, $query);
                
                while ($row = mysqli_fetch_array($result)) {
                    echo "<b>";
                    echo $row['Beskrivelse'];
                    echo "</b><br>";
                    echo $row ['motor'];
                    echo "<br>";
                    echo $row ['esc'];
                    echo "<br>";
                    echo $row ['kbrett'];
                    echo "<br>";
                    echo $row ['Prop_dia'] . '"x' . $row ['Prop_vin'];
                    echo "<br>";
                    echo $row ['Celler'] . 'S ' . $row ['mah'] . 'mah ' . $row ['C_max'] . 'C';
                    echo "<br>";
                }


                echo' <br> <a href="http://smp.no"><img src="main_styling/velg.png"></a>
                        <a href="config.php"><img src="main_styling/config.png"></a>
                    </div></div></div>';
                ?>
    </body>
</html>                 
