<?php
include './dbConnect.php';
include './editPkgFuncParts.php';
//include 'checklogin.php';
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
            <div id="Content">
                <div id=" ">
                    <form name="pkgRem" method="POST">
                        <table border="1">
                            <tr>
                                <th></th>
                                <th>Oppskrift ID</th>
                                <th>Beskrivelse</th>
                                <th>Motor</th>
                                <th>ESC</th>
                                <th>Kontrollbrett</th>
                                <th>Propell</th>
                                <th>Batteri</th>
                            </tr>
                            <?php
                            //shit comes here
                            $con = $_SESSION['connection'];

                            if (isset($_POST['oppID'])) {
                                foreach ($_POST['oppID'] as $oppIDarrayNumberYes) {
                                    $Query = 'DELETE FROM oppskrift WHERE OppskriftID=' . $oppIDarrayNumberYes;
                                    mysqli_query($con, $Query);
                                }
                            }

                            $Query = 'CALL getOppskrift()';
                            $result = mysqli_query($con, $Query);

                            while ($row = mysqli_fetch_array($result)) {
                                echo '<tr>';
                                echo '<td><input type="checkbox" name="oppID[]" value="' . $row['OppskriftID'] . '"></td>';
                                echo '<td>' . $row['OppskriftID'] . '</td>';
                                echo '<td>' . $row['Beskrivelse'] . '</td>';
                                echo '<td>' . $row['motor'] . '</td>';
                                echo '<td>' . $row['esc'] . '</td>';
                                echo '<td>' . $row['kbrett'] . '</td>';
                                echo '<td>' . $row['Prop_dia'] . 'x' . $row['Prop_vin'] . '</td>';
                                echo '<td>' . $row['Celler'] . ' Cell ' . $row['mah'] . ' mah ' . $row['C_max'] . 'C</td>';
                                //legg inn knapp for å delete her, må sikkert legge dritten inn i en form.
                                //yes, hele dritten skal inn i en form + skal ha kun en knapp men mange checkbuttons eller hvadetnåheter.
                            }
                            mysqli_close($con);
                            ?>
                        </table>
                        <input type = "submit" name = "submit" value = "Fullfør">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
