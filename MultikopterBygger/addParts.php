<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == FALSE) {
    header('Location: login.php');
}

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
            <div id="leftcontent">

                <?php
                if (isset($_POST['part'])) {
                    $part = $_POST['part'];
                } else {
                    $part = '';
                }

                echo'
                <form>
                    <select name="part" onchange="document.location.href=this.value">
                        <option value="">----Velg type del----</option>
                        <option value="addParts.php?f=addmotor">Motor</option>
                        <option value="addParts.php?f=addesc">ESC</option>
                        <option value="addParts.php?f=addboard">Kontrollbrett</option>
                        <option value="addParts.php?f=addprop">Propell</option>
                        <option value="addParts.php?f=addbat">Batteri</option>
                    </select>
                </form><br>';

                if (function_exists($_GET['f'])) {
                    $_GET['f']();
                }

                function addmotor() {
                    echo '
                    Angi verdier som skal legges inn for motoren:<br>
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
                    </form>';

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
                        $row = mysqli_fetch_array($result);
                        $lMotorID = $row['MotorID'] + 1;

                        $Query = "INSERT INTO `motor`(`MotorID`, `kV`, `Amps`, `Pris`, `Prop_dia`, `Prop_vin`, `CE_MAX`, `CE_MIN`, `Navn`) VALUES ("
                                . $lMotorID . "," . $kvInput . "," . $ampInput . "," . $prisInput . "," . $prop_dia . "," . $prop_vin . "," . $CE_max
                                . "," . $CE_min . "," . $navn . ")";
                        mysqli_query($con, $Query);
                        mysqli_close($con);
                    }
                }

                function addEsc() {
                    echo '
                    Angi verdier som skal legges inn for ESC-en:<br>
                    <form name="escAddForm" method="POST">
                        <input min="0" type="number" name="ampInput" placeholder="Ampere"><br>
                        <input min="0" type="number" name="ce_maxInput" placeholder="Lipocell max"><br>
                        <input min="0" type="number" name="ce_minInput" placeholder="Lipocell min"><br>
                        <input min="0" type="number" name="prisInput" placeholder="Pris"><br>
                        <input size="50" type="text" name="navnInput" placeholder="Navn"><br>
                        <input type="submit" name="submit">
                    </form>';

                    if (isset($_POST['submit'])) {
                        $con = $_SESSION['connection'];

                        $ampInput = $_POST['ampInput'];
                        $CE_max = $_POST['ce_maxInput'];
                        $CE_min = $_POST['ce_minInput'];
                        $prisInput = $_POST['prisInput'];
                        $navnInput = $_POST['navnInput'];

                        $Query = "SELECT `ESCID` FROM `esc` ORDER BY ESCID DESC LIMIT 1";
                        $result = mysqli_query($con, $Query);
                        $row = mysqli_fetch_array($result);
                        $lEscId = $row['ESCID'] + 1;

                        $Query = "INSERT INTO `esc`(`ESCID`, `Ampere`, `CE_max`, `CE_min`, `Pris`, `Navn`) "
                                . "VALUES (" . $lEscId . ',' . $ampInput . ',' . $CE_max . ','
                                . $CE_min . ',' . $prisInput . ',' . $navnInput . ")";
                        mysqli_query($con, $Query);
                        mysqli_close($con);
                    }
                }

                function addboard() {
                    echo '
                    Angi verdier som skal legges inn for kontrollbrettet:
                    <form name="addKontrollbrettForm" method="POST">
                        <input min="0" type="number" name="rotor_minInput" placeholder="Rotor min"><br>
                        <input min="0" type="number" name="rotor_maxInput" placeholder="Rotor max"><br>
                        <input min="0" type="number" name="prisInput" placeholder="Pris"><br>
                        <input size="50" type="text" name="navnInput" placeholder="Navn"><br>
                        GPS <input type="checkbox" name="gpsInput"><br>
                        <input type="submit" name="submit">
                    </form>';

                    if (isset($_POST['submit'])) {
                        $con = $_SESSION['connection'];

                        $r_minInput = $_POST['rotor_minInput'];
                        $r_maxInput = $_POST['rotor_maxInput'];
                        $prisInput = $_POST['prisInput'];
                        $navnInput = $_POST['navnInput'];

                        if (isset($_POST['gpsInput'])) {
                            $gpsInput = 'ja';
                        } else {
                            $gpsInput = 'nei';
                        }

                        $Query = "SELECT `KontrollbrettID` FROM `kontrollbrett` "
                                . "ORDER BY `KontrollbrettID` DESC LIMIT 1";
                        $result = mysqli_query($con, $Query);
                        $row = mysqli_fetch_array($result);
                        $lKontrollbrettId = $row['KontrollbrettID'] + 1;

                        $Query = "INSERT INTO `kontrollbrett`(`KontrollbrettID`, `Rotor_min`, `Rotor_max`, `GPS`, "
                                . "`Pris`, `Navn`) "
                                . "VALUES (" . $lKontrollbrettId . ',' . $r_minInput . ',' . $r_maxInput . ','
                                . '"' . $gpsInput . '"' . ',' . $prisInput . ',' . $navnInput . ")";
                        mysqli_query($con, $Query);
                        mysqli_close($con);
                    }
                }

                function addprop() {
                    echo '
                    <form name="propellAdd" method="POST">
                        <input min="0" type="number" name="prop_diaInput" placeholder="Propell diameter i tommer"><br>
                        <input min="0" type="number" name="prop_vinInput" placeholder="Propell vinklel"><br>
                        <input min="0" type="number" name="prisInput" placeholder="Pris"><br>
                        <input size="50" type="text" name="navnInput" placeholder="Navn"><br>
                        <input type="submit" name="submit">
                    </form>';
                    if (isset($_POST['submit'])) {
                        $con = $_SESSION['connection'];
                        $prop_dia = $_POST['prop_diaInput'];
                        $prop_vin = $_POST['prop_vinInput'];
                        $pris = $_POST['prisInput'];
                        $navn = $_POST['navnInput'];

                        $Query = "SELECT `PropellID` FROM propeller ORDER BY `PropellID` DESC LIMIT 1";
                        $result = mysqli_query($con, $Query);
                        $row = mysqli_fetch_array($result);
                        $lPropellId = $row['PropellID'] + 1;

                        $Query = "INSERT INTO `propeller`(`PropellID`, `Prop_dia`, `Prop_vin`, `Pris`, `Navn`) "
                                . "VALUES (" . $lPropellId . ',' . $prop_dia . ',' . $prop_vin . ',' . $pris . ',' . $navn . ")";
                        mysqli_query($con, $Query);
                        mysqli_close($con);
                    }
                }

                function addbat() {
                    echo '
                    <form name="batteriAdd" method="POST">
                        <input min="0" type="number" name="cMax" placeholder="max strømtrekk"><br>
                        <input min="0" type="number" name="mah" placeholder="mah"><br>
                        <input min="0" type="number" name="celler" placeholder="Antall celler"><br>
                        <input min="0" type="number" name="pris" placeholder="Pris"><br>
                        <input type="submit" name="submit">
                    </form>';
                    if (isset($_POST['submit'])) {
                        $con = $_SESSION['connection'];
                        
                        $cMax = $_POST['cMax'];
                        $mah = $_POST['mah'];
                        $celler = $_POST['celler'];
                        $pris = $_POST['pris'];
                        
                        $Query = "SELECT `BatteriID` FROM batteri ORDER BY `BatteriID` DESC LIMIT 1";
                        $result = mysqli_query($con, $Query);
                        $row = mysqli_fetch_array($result);
                        $lBatId = $row['BatteriID'] + 1;
                        
                        $Query = "INSERT INTO `batteri`(`BatteriID`, `C_max`, `mah`, `Celler`, `Pris`) "
                                . "VALUES (" . $lBatId . ',' . $cMax . ',' . $mah . ',' . $celler . ',' . $pris . ")";
                        mysqli_query($con, $Query);
                        mysqli_close($con);
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>