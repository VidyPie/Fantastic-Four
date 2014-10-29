<?php
include 'dbConnect.php';
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
                if (isset($_POST['videoopptak'])) {
                    $videoopptak = $_POST['videoopptak'];
                    $airtime = $_POST['airtime'];
                    $gps = $_POST['gps'];
                    $specquery = "SELECT `SpesifikasjonID` FROM `spesifikasjoner` WHERE `Rekkevidde` = '"
                            . $airtime . "' AND `Videoopptak` = '" . $videoopptak . "' AND `GPS` = '" . $gps . "';";
                    $specresult = mysqli_query($con, $specquery);
                    $srow = mysqli_fetch_array($specresult);
                    $specID = $srow['SpesifikasjonID'];
                    $query = 'CALL getPacket(' . $specID . ')';
                    $result = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_array($result)) {
                        echo ' <div id="left_box"><b>Forslag 1</b> <br><br>';
                        $oID = $row['OppskriftID'];
                        echo '<img class="copterimg" src="main_styling/fl_hex.jpg" width="500" alt="quad"><br>';
                        echo $row['Beskrivelse'];
                        echo '<ul style="list-style-type:none">';
                        echo '<li>Motor: ' . $row['motor'] . '</li>';
                        echo '<li>ESC: ' . $row['esc'] . '</li>';
                        echo '<li>Kontrollbrett: ' . $row['kbrett'] . '</li>';
                        echo '<li>Propell: ' . $row['Prop_dia'] . '"x' . $row['Prop_vin'] . ' propeller</li>';
                        echo '<li>Batteri: ' . $row['Celler'] . 'S ' . $row['mah'] . 'mah ' . $row['C_max'] . 'C' . '</li>';
                        echo '</ul>';
                        echo' <br> <a id="chbutton" href="resultat.php">Velg</a><a class="cobutton" href="config.php?c=' . $oID . '">Konfig</a>
                    </div>';
                    }
                    echo '</div></div>';
                } else {
                    header('Location: skjema.html');
                }
                ?>
                </body>
                </html>                 
