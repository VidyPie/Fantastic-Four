<?php
include './dbConnect.php';
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
            <div id="leftContent">
                <?php
                $con = $_SESSION['connection'];

                $motorID = $_SESSION['MotorID'];
                $propellID = $_SESSION['PropellID'];
                $batteriID = $_SESSION['BatteriID'];
                $kontrollbrettID = $_SESSION['KontrollbrettID'];
                $ESCID = $_SESSION['ESCID'];

                $Query = 'SELECT b.*, p.*, e.Navn AS esc, m.Navn AS motor, k.Navn AS kontrollbrett '
                        . 'FROM ESC AS e, Batteri AS b, Motor AS m, Propeller AS p, Kontrollbrett AS k '
                        . 'WHERE e.ESCID = ' . $ESCID . ' AND b.BatteriID = ' . $batteriID . ' AND m.MotorID = ' . $motorID
                        . ' AND p.PropellID = ' . $propellID . ' AND k.KontrollbrettID = ' . $kontrollbrettID;
                $result = mysqli_query($con, $Query);
                $row = mysqli_fetch_array($result);

                echo '<div id="summary"> '
                . 'Her er en oppsummering av oppsettet som har blitt valgt:'
                . '<br>'
                . '<p><b>Motor:</b> ' . $row['motor'] . '</p>'
                . '<p><b>ESC:</b> ' . $row['esc'] . '</p>'
                . '<p><b>Kontrollbrett:</b> ' . $row['kontrollbrett'] . '</p>'
                . '<p><b>Propell:</b> ' . $row['Prop_dia'] . 'x' . $row['Prop_vin'] . '</p>'
                . '<p><b>Batteri:</b> ' . $row['Celler'] . '-Cell ' . $row['mah'] . 'mah ' . $row['C_max'] . 'C </p>'
                . '</div>'
                ?>
                <br><br>
                <p>
                    Neste steg? Bestill delene selvfølgelig! <i>Merk at du i tillegg til dette må ha radiostyring, mottaker og batterilader.</i>
                </p>
                <p>
                    Gode steder å bestille deler kan være:
                <ul style="list-style-type:none">
                    <li><a href="www.modellers.com">Modellers</a></li>
                    <li><a href="www.elefun.com">Elefun</a></li>
                    <li><a href="www.hobbyking.com">Hobbyking</a></li>
                </ul>
                </p>
            </div>
        </div>
    </body>
</html>
