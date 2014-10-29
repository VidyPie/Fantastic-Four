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

                $motorID = $_SESSION['motorSelected'];
                $propellID = $_SESSION['propellSelected'];
                $batteriID = $_SESSION['batteriSelected'];
                $kontrollbrettID = $_SESSION['kontrollBrettSelected'];
                $ESCID = $_SESSION['ESCSelected'];

                $Query = 'SELECT b.*, p.*, e.Navn AS esc, m.Navn AS motor, k.Navn AS kontrollbrett '
                        . 'FROM ESC AS e, Batteri AS b, Motor AS m, Propeller AS p, Kontrollbrett AS k '
                        . 'WHERE e.ESCID = ' . $ESCID . ' AND b.BatteriID = ' . $batteriID . ' AND m.MotorID = ' . $motorID
                        . ' AND p.PropellID = ' . $propellID . ' AND k.KontrollbrettID = ' . $kontrollbrettID;
                $result = mysqli_query($con, $Query);
                $row = mysqli_fetch_array($result);

                echo '<div id="summary">'
                . '<ul style="list-style-type:none">'
                . '<li>Her er en oppsummering av oppsettet som har blitt valgt:</li>'
                . '<br>'
                . '<li>Motor: ' . $row['motor'] . '</li>'
                . '<li>ESC: ' . $row['esc'] . '</li>'
                . '<li>Kontrollbrett: ' . $row['kontrollbrett'] . '</li>'
                . '<li>Propell: ' . $row['Prop_dia'] . 'x' . $row['Prop_vin'] . '</li>'
                . '<li>Batteri: ' . $row['Celler'] . '-Cell ' . $row['mah'] . 'mah ' . $row['C_max'] . 'C ' . '</li>'
                . '</ul>'
                . '</div>'
                ?>
            </div>
        </div>
    </body>
</html>
