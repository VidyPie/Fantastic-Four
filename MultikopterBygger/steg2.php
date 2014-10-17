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
                $con = $_SESSION['connection'];
                $videoopptak = $_POST['videoopptak'];
                $airtime = $_POST['airtime'];
                $gps = $_POST['gps'];
                //$query = "SELECT * FROM oppskrift";
                $query = "SELECT `SpesifikasjonID` FROM `spesifikasjoner` WHERE `Rekkevidde` = '" . $airtime . "' AND `Videoopptak` = '" . $videoopptak . "' AND `GPS` = '" . $gps . "';";
                $result = mysqli_query($con, $query);


                while ($row = mysqli_fetch_array($result)) {
                    $specID = $row['SpesifikasjonID'];
                }


                $query = "SELECT KomponenterID FROM `oppskrift` WHERE `SpesifikasjonID` = '" . $specID . "';";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                    $komponentID = $row['KomponenterID'];
                    $query = "SELECT * FROM `Komponenter` WHERE `KomponenterID` = '" . $komponentID . "';";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        $motorID = $row['MotorID'];
                        $escID = $row['ESCID'];
                        $batteriID = $row['BatteriID'];
                        $kontrollBrettID = $row['KontrollbrettID'];
                        $proppellID = $row['PropellID'];


                        //sender videre til config side...
                        $_SESSION['motorSelected'] = $motorID;
                        $_SESSION['propellSelected'] = $proppellID;
                        $_SESSION['batteriSelected'] = $batteriID;
                        $_SESSION['kontrollBrettSelected'] = $kontrollBrettID;
                        $_SESSION['ESCSelected'] = $escID;
                    }
                    echo ' <div id="left_box"><b>Forslag 1</b> <br><br>';
                    $query = "SELECT * FROM `oppskrift` WHERE `KomponenterID` = '" . $komponentID . "';";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        $beskrivelseResult = $row['Beskrivelse'];
                        echo "<b>";
                        echo $beskrivelseResult;
                        echo "</b><br>";
                    }
                    $motorquery = "SELECT `Navn` FROM `Motor` WHERE motorID=" . $motorID;
                    $escquery = "SELECT `Navn` FROM `ESC` WHERE ESCID=" . $escID;
                    $batteriquery = "SELECT * FROM `Batteri` WHERE BatteriID=" . $batteriID;
                    $kontrollbrettquery = "SELECT `Navn` FROM `Kontrollbrett` WHERE KontrollbrettID=" . $kontrollBrettID;
                    $propellquery = "SELECT * FROM `Propeller` WHERE PropellID=" . $proppellID;
                    $array = [$motorquery, $escquery, $batteriquery, $kontrollbrettquery, $propellquery];
                    foreach ($array as $selected) {
                        $result = mysqli_query($con, $selected);
                        while ($row = mysqli_fetch_array($result)) {
                            if ($selected == $propellquery) {
                                echo $row ['Prop_dia'] . '"x' . $row ['Prop_vin'];
                                echo "<br>";
                            } elseif ($selected == $batteriquery) {
                                echo $row ['Celler'] . 'S ' . $row ['mah'] . 'mah ' . $row ['C_max'] . 'C';
                                echo "<br>";
                            } else {
                                echo $row ['Navn'];
                                echo "<br>";
                            }
                        }
                    }

                    echo' <br> <a href="http://smp.no"><img src="main_styling/velg.png"></a>
                        <a href="config.php"><img src="main_styling/config.png"></a>
                    </div></div></div>';
                }
                ?>


                </body>
                </html>                 
