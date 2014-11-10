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
                    $forslagNr=1;

                    while ($row = mysqli_fetch_array($result)) {
                        echo ' <div id="left_box"><b>Forslag ' . $forslagNr . '</b><br><br>';
                        $oID = $row['OppskriftID'];
                        $forslagNr = $forslagNr + 1;
                        echo '<img class="copterimg" src="main_styling/fl_hex.jpg" width="500" alt="quad"><br><br>';
                        $desc = $row['Beskrivelse'];
                        echo '<div id="desc">' . $desc . '</div>';
                        echo '<div id="pktDesc"><br>';

                        echo '<p><b>Motor:</b> ' . $row['motor'] . '</p>';
                        echo '<p><b>ESC:</b> ' . $row['esc'] . '</p>';
                        echo '<p><b>Kontrollbrett:</b> ' . $row['kbrett'] . '</p>';
                        echo '<p><b>Propell:</b> ' . $row['Prop_dia'] . '"x' . $row['Prop_vin'] . ' propeller</p>';
                        echo '<p><b>Batteri:</b> ' . $row['Celler'] . 'S ' . $row['mah'] . 'mah ' . $row['C_max'] . 'C' . '</p>';
                        
                        echo' <br><div id="divButton"><a class="chButton" href="powatodappl.php?c=' . $oID . '">Velg</a>&nbsp; '
                        . '<a class="coButton" href="config.php?c=' . $oID . '">Konfigurer</a></div></div></div>';
                    }
                    echo '<div id="divButton"><a class="angreButton" href="skjema.html">Angre</a></div></div></div>';
                } else {
                    header('Location: skjema.html');
                }
                ?>
                </body>
                </html>                 
