<?php
include 'dbConnect.php';
include 'checklogin.php';
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
        <div id='wrapper'>
            <div id='leftContent'>
                <a href="administrasjon.php">Tilbake</a><br>
                <form name="components" method="POST">
                    <?php
                    $con = $_SESSION['connection'];

                    $dropdownarray = array('motordropdown', 'escdropdown', 'propdropdown', 'kontrollbrettdropdown', 'batteridropdown');
                    $plist = array('motor', 'esc', 'propeller', 'kontrollbrett', 'batteri');
                    $pIDlist = array('motor' => 'MotorID', 'esc' => 'ESCID', 'kontrollbrett' => 'KontrollbrettID');
                    $x = 0;

                    echo '<div id="dropdown"><p>Velg komponenter for pakke:</p>' . "\n";
                    foreach ($dropdownarray as $ddlist) {
                        echo '<select name="' . $ddlist . '">' . "\n";
                        echo '<option value="0">----Velg ' . $plist[$x] . '----</option>' . "\n";
                        $query = "SELECT * FROM " . $plist[$x];
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            if ($plist[$x] == 'batteri') {
                                $mahResult = $row['mah'];
                                $cResult = $row['C_max'];
                                $sResult = $row['Celler'];
                                $idResult = $row['BatteriID'];
                                echo '<option value="' . $idResult . '">' . $sResult
                                . 'S ' . $mahResult . 'mah ' . $cResult . 'C' . '</option>' . "\n";
                            } else if ($plist[$x] == 'propeller') {
                                $nameResult = $row['Navn'];
                                $idResult = $row['PropellID'];
                                $diaResult = $row['Prop_dia'];
                                $vinResult = $row['Prop_vin'];
                                echo '<option value="' . $idResult . '">' . $nameResult
                                . ' ' . $diaResult . '"x' . $vinResult . '</option>' . "\n";
                            } else {
                                $nameResult = $row['Navn'];
                                $idResult = $row[$pIDlist[$plist[$x]]];
                                echo '<option value="' . $idResult . '">' . $nameResult . '</option>' . "\n";
                            }
                        }
                        echo '</select><br>';
                        $x++;
                    }
                    ?>
                    <p>Gi en kort beskrivelse av pakken (maks 250 tegn):</p>
                    <textarea required="yes" id="beskr" name="beskrfelt" rows="8"></textarea>
            </div>
            Velg hvilke kategorier pakken skal ligge under:
            <table border="1">
                <tr>
                    <th></th>
                    <th>Videoopptak</th>
                    <th>Flytid</th>
                    <th>GPS</th>
                </tr>
                <?php
                $query = "SELECT * FROM spesifikasjoner";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo "\n" . '<td><input type="checkbox" name="specs[]" value="' . $row['SpesifikasjonID'] . '"></td>';
                    echo "\n" . '<td>' . $row['Videoopptak'] . '</td>';
                    echo "\n" . '<td>' . $row['Rekkevidde'] . '</td>';
                    echo "\n" . '<td>' . $row['GPS'] . '</td>';
                    echo "\n" . '</tr>' . "\n";
                }
                echo '<input type="submit" name="submit" value="Legg inn">';
                echo '</form>';
                ?>
            </table>

            <?php
            if (isset($_POST['submit'])) {
                $con = $_SESSION['connection'];

                $kompquery = "INSERT INTO `komponenter` (`BatteriID`, "
                        . "`KontrollbrettID`, `PropellID`, `MotorID`, `ESCID`) VALUES (";

                $vals = 0;
                $check_array = array('batteridropdown', 'kontrollbrettdropdown', 'propdropdown', 'motordropdown', 'escdropdown');
                foreach ($check_array as $variable_name) {
                    if (isset($_POST[$variable_name])) {
                        $listvalue = $_POST[$variable_name];
                        if ($listvalue != 0) {
                            $kompquery .= $_POST[$variable_name];
                            $vals ++;
                        }
                    }
                    if ($variable_name == 'escdropdown') {
                        $kompquery .= ");\n";
                    } else {
                        $kompquery .= ", ";
                    }
                }
                mysqli_query($con, $kompquery);

                //echo mysqli_sqlstate($con);
                
                if (mysqli_sqlstate($con) == 45000) {
                    echo 'ESC is not compatible with the engine';
                } else {

                    $partsid = mysqli_fetch_array(mysqli_query
                                            ($con, "SELECT MAX(KomponenterID) AS id FROM komponenter"))['id'];

                    if (!empty($_POST['specs']) && $vals == 5) {
                        foreach ($_POST['specs'] as $spec) {
                            $query = "INSERT INTO `oppskrift`(`SpesifikasjonID`, "
                                    . "`KomponenterID`, `Beskrivelse`) VALUES (" . $spec
                                    . ", " . $partsid . ", '" . $_POST['beskrfelt'] . "');";
                            mysqli_query($con, $query);
                        }
                    } elseif ($vals > 0) {
                        echo 'Alle verdier må velges';
                    } elseif (empty($_POST['specs'])) {
                        echo 'Velg en eller flere kategorier';
                    } else {
                        echo 'Pakke lagt til';
                    }
                }
            }
            mysqli_close($con);
            ?>
        </div>
    </div>

</body>
</html>

