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
                    $query = "SELECT * FROM oppskrift";
                    $query = "SELECT `SpesifikasjonID` FROM `spesifikasjoner` WHERE `Rekkevidde` = '" . $airtime . "' AND `Videoopptak` = '" . $videoopptak . "' AND `GPS` = '" . $gps . "';";
                    $result = mysqli_query($con, $query);
                    echo $query;
                    while ($row = mysqli_fetch_array($result)) {
                        $specID = $row['SpesifikasjonID'];
                        echo $specID;
                    }


                    $query = "SELECT KomponenterID FROM `oppskrift` WHERE `SpesifikasjonID` = '" . $specID . "';";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        $komponentID = $row['KomponenterID'];
                        $query = "SELECT * FROM `Komponenter` WHERE `KomponenterID` = '" . $komponentID . "';";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $motorID = $row['motorID'];
                            $escID = $row['ESCID'];
                            $batteriID = $row['BatteriID'];
                            $kontrollBrettID = $row['KontrollbrettID'];
                            $proppellID = $row['PropellID'];
                        }
                        echo ' <div id="left_box"><b>Forslag 1</b> <br><br>';                      
                        $query = "SELECT * FROM oppskrift";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $beskrivelseResult = $row['Beskrivelse'];
                            echo $beskrivelseResult;
                        }
                            $motorquery = "SELECT `Navn` FROM `Motor` WHERE motorID=" . $motorID;
                            $escquery = "SELECT `Navn` FROM `ESC` WHERE ESCID=" . $escID;
                            $batteriquery = "SELECT * FROM `Batteri` WHERE BatteriID=" . $batteriID;
                            $kontrollbrettquery = "SELECT `Navn` FROM `Kontrollbrett` WHERE KontrollbrettID=" . $KontrollBrettID;
                            $propellquery = "SELECT * FROM `Propeller` WHERE PropellID=" . $proppellID;
                            $array = [$motorquery, $escquery, $batteriquery, $kontrollbrettquery, $propellquery];
                         foreach($array as $selected) {
                            $result = mysqli_query($con, $selected);
                            while ($row = mysqli_fetch_array($result)) {
                                if($selected == $propellquery)
                                {
                                    echo $row ['Prop_dia'] . '"x' .$row ['Prop_vin'];
                                }
                                elseif($selected == $batteriqueryt)
                                {
                                    echo $row ['Celler'] .'S ' . $row ['mah'] . 'mah ' . $row ['C_max'] . 'C';  
                                }
                                else {
                                    echo $row ['Navn'];
                                }
                     
                            }
                         
                         }
                        
                        echo'  <a href="http://smp.no"><img src="main_styling/velg.png"></a>
                        <a href="http://reddit.com"><img src="main_styling/config.png"></a>
                    </div></div></div>';
                    }
                   
                            
                    ?>

   
    </body>
</html>                 
