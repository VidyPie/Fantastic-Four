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
        <div id="buildimage">
            <img src="main_styling/base.png">
            <img src="main_styling/propellselected.png" id="propellselected" style="display:none;">
            <img src="main_styling/motorselected.png" id="motorselected" style="display:none;">
            <img src="main_styling/escselected.png" id="escselected" style="display:none;">
            <img src="main_styling/kontrollbrettselected.png" id="kontrollbrettselected" style="display:none;">
            <img src="main_styling/batteriselected.png" id="batteriselected" style="display:none;">
        </div>
        <div id="wrapper">
            <div id="content">
                <form name="components2">

                    <?php
                    $con = $_SESSION['connection'];
                    echo '<div id="configMagic">';

                    $IDval = array("MotorID" => 1, "ESCID" => 1, "KontrollbrettID" => 1, "PropellID" => 1, "BatteriID" => 1);
                    $IDnam = array("MotorID", "ESCID", "KontrollbrettID", "PropellID", "BatteriID");

                    foreach ($IDnam as $namsel) {
                        if (isset($_SESSION[$namsel]))
                            $IDval[$namsel] = $_SESSION[$namsel];
                    }

                    $sel_array = array("motorSelected", "ESCSelected", "kontrollbrettSelected", "propellSelected", "batteriSelected");
                    $sel_array_link = array("motorSelected" => "MotorID", "ESCSelected" => "ESCID",
                        "kontrollbrettSelected" => "KontrollbrettID", "propellSelected" => "PropellID", "batteriSelected" => "BatteriID");

                    if (isset($_GET['c'])) {
                        $IDquery = 'SELECT m.MotorID, p.PropellID, b.BatteriID, kon.KontrollbrettID, esc.ESCID '
                                . 'FROM motor AS m, propeller AS p, batteri AS b, kontrollbrett AS kon, esc, oppskrift AS o, komponenter AS kom '
                                . 'WHERE o.KomponenterID = kom.KomponenterID AND kom.MotorID = m.MotorID AND kom.BatteriID = b.BatteriID AND kom.ESCID = esc.ESCID '
                                . 'AND kom.KontrollbrettID = kon.KontrollbrettID AND kom.PropellID = p.PropellID AND o.OppskriftID=' . $_GET['c'];
                        $IDresult = mysqli_query($con, $IDquery);
                        $resultArray = mysqli_fetch_array($IDresult);

                        foreach ($IDnam as $namsel) {
                            $IDval[$namsel] = $_SESSION[$namsel] = $resultArray[$namsel];
                        }
                    } else {
                        foreach ($sel_array as $selected) {
                            if (isset($_GET[$selected])) {
                                $_SESSION[$sel_array_link[$selected]] = $IDval[$sel_array_link[$selected]] = $_GET[$selected];
                                echo 'Session name: ' . $sel_array_link[$selected];
                            }
                        }
                    }
                    
                    //MOTORMOTORMOTOR
                    $motorAdvQuery = "SELECT * FROM motor WHERE MotorID=" . $IDval['MotorID'];
                    $motorAdvResult = mysqli_query($con, $motorAdvQuery);
                    $motorRow = mysqli_fetch_array($motorAdvResult);
                    echo '<div id="component">';
                    echo '<div id="componentHead">MOTOR<br></div>';
                    echo '<div id="mainComponent">' . $motorRow['Navn'] . '</div>';
                    echo '<div id="configstats">kV: <div id="pureStat">&nbsp' . $motorRow['kV'] . '&nbsp</div></div>';
                    echo '<div id="configstats">Amps: <div id="pureStat">&nbsp' . $motorRow['Amps'] . '&nbsp</div></div>';
                    echo '<input type="button" id="dynamicMotorTable" onclick="openMotorTable()" style="display:block;" value="BYTT MOTOR">';
                    echo '<div id="motorTable" style="display:none;"><table><br>';
                    echo '<tr><td><b>Navn</td><td><b>kV</td><td><b>Amps</td><td></td></tr>';
                    $motorAdvInvQuery = "SELECT * FROM motor WHERE MotorID != " . $IDval['MotorID'];
                    $motorAdvInv = mysqli_query($con, $motorAdvInvQuery);
                    echo '<form method="GET">';
                    while ($row = mysqli_fetch_array($motorAdvInv)) {
                        $thisMotor = $row['MotorID'];
                        echo '<tr><td>' . $row['Navn'] . '</td><td>' . $row['kV'] . '</td><td>' . $row['Amps'] . '</td><td><input type="radio" name="motorSelected" value="' . $thisMotor . '"></td>';
                    }
                    echo '</form></table><div id="tableButtons"><input type="reset" value="Avbryt" id="cancelChoice" onclick="openMotorTable()"><input type="submit" value="Velg" id="chooseThis"></div></div></div><br>';

                    //ESCESCESC
                    $ESCAdvQuery = 'SELECT * FROM esc WHERE ESCID= ' . $IDval['ESCID'];
                    $ESCAdvResult = mysqli_query($con, $ESCAdvQuery);
                    $ESCRow = mysqli_fetch_array($ESCAdvResult);
                    echo '<div id="component">';
                    echo '<div id="componentHead">ESC<br></div>';
                    echo '<div id="mainComponent">' . $ESCRow['Navn'] . '</div>';
                    echo '<div id="configstats">Ampere: <div id="pureStat">&nbsp' . $ESCRow['Ampere'] . '&nbsp</div></div>';
                    echo '<input type="button" id="dynamicESCTable" onclick="openESCTable()" style="display:block;" value="BYTT ESC">';
                    echo '<div id="ESCTable" style="display:none;"><table><br>';
                    echo '<tr><td><b>Navn</td><td><b>Ampere</td><td></td></tr>';
                    $ESCAdvInvQuery = "SELECT * FROM esc WHERE ESCID != " . $IDval['ESCID'];
                    $ESCAdvInv = mysqli_query($con, $ESCAdvInvQuery);
                    echo '<form method="GET">';
                    while ($row = mysqli_fetch_array($ESCAdvInv)) {
                        $thisESC = $row['ESCID'];
                        echo '<tr><td>' . $row['Navn'] . '</td><td>' . $row['Ampere'] . '</td><td><input type="radio" name="ESCSelected" value="' . $thisESC . '"></td>';
                    }
                    echo '</table><div id="tableButtons"><input type="reset" value="Avbryt" id="cancelChoice" onclick="openESCTable()"><input type="submit" value="Velg" id="chooseThis"></form></div></div></div><br>';

                    //KONTROLLBRETTKONTROLLBRETTKONTROLLBRETT
                    $kontrollbrettAdvQuery = 'SELECT * FROM kontrollbrett WHERE KontrollbrettID= ' . $IDval['KontrollbrettID'];
                    $kontrollbrettAdvResult = mysqli_query($con, $kontrollbrettAdvQuery);
                    $kontrollbrettRow = mysqli_fetch_array($kontrollbrettAdvResult);
                    echo '<div id="component">';
                    echo '<div id="componentHead">KONTROLLBRETT<br></div>';
                    echo '<div id="mainComponent">' . $kontrollbrettRow['Navn'] . '</div>';
                    echo '<div id="configstats">Min. Rotor: <div id="pureStat">&nbsp' . $kontrollbrettRow['Rotor_min'] . '&nbsp</div></div>';
                    echo '<div id="configstats">Max. Rotor: <div id="pureStat">&nbsp' . $kontrollbrettRow['Rotor_max'] . '&nbsp</div></div>';
                    echo '<div id="configstats">GPS: <div id="pureStat">&nbsp' . $kontrollbrettRow['GPS'] . '&nbsp</div></div>';
                    echo '<input type="button" id="dynamicKontrollbrettTable" onclick="openKontrollbrettTable()" style="display:block;" value="BYTT KONTROLLBRETT">';
                    echo '<div id="kontrollbrettTable" style="display:none;"><table><br>';
                    echo '<tr><td><b>Navn</td><td><b>Min. Rotor</td><td><b>Max. Rotor</td><td><b>GPS</td><td></td></tr>';
                    $kontrollbrettAdvInvQuery = "SELECT * FROM kontrollbrett WHERE KontrollbrettID != " . $IDval['KontrollbrettID'];
                    $kontrollbrettAdvInv = mysqli_query($con, $kontrollbrettAdvInvQuery);
                    echo '<form method="GET">';
                    while ($row = mysqli_fetch_array($kontrollbrettAdvInv)) {
                        $thisKontrollbrett = $row['KontrollbrettID'];
                        echo '<tr><td>' . $row['Navn'] . '</td><td>' . $row['Rotor_min'] . '</td><td>' . $row['Rotor_max'] . '</td><td>' . $row['GPS'] . '</td><td><input type="radio" name="kontrollbrettSelected" value="' . $thisKontrollbrett . '"></td>';
                    }
                    echo '</table><div id="tableButtons"><input type="reset" value="Avbryt" id="cancelChoice" onclick="openKontrollbrettTable()"><input type="submit" value="Velg" id="chooseThis"></form></div></div></div><br>';

                    //PROPELLPROPELLPROPELL
                    $propellAdvQuery = 'SELECT * FROM propeller WHERE propellID= ' . $IDval['PropellID'];
                    $propellAdvResult = mysqli_query($con, $propellAdvQuery);
                    $propellRow = mysqli_fetch_array($propellAdvResult);
                    echo '<div id="component">';
                    echo '<div id="componentHead">Propell<br></div>';
                    echo '<div id="mainComponent">' . $propellRow['Prop_dia'] . '"x';
                    echo $propellRow['Prop_vin'] . ' propeller</div>';
                    echo '<div id="configstats">Diameter: <div id="pureStat">&nbsp' . $propellRow['Prop_dia'] . '&nbsp</div></div>';
                    echo '<div id="configstats">Vinkling: <div id="pureStat">&nbsp' . $propellRow['Prop_vin'] . '&nbsp</div></div>';
                    echo '<input type="button" id="dynamicPropellTable" onclick="openPropellTable()" style="display:block;" value="BYTT PROPELLER">';
                    echo '<div id="propellTable" style="display:none;"><table><br>';
                    echo '<tr><td><b>Diameter</td><td><b>Vinkling</td><td></td></tr>';
                    $propellAdvInvQuery = "SELECT * FROM propeller WHERE propellID != " . $IDval['PropellID'];
                    $propellAdvInv = mysqli_query($con, $propellAdvInvQuery);
                    echo '<form method="GET">';
                    while ($row = mysqli_fetch_array($propellAdvInv)) {
                        $thisPropell = $row['PropellID'];
                        echo '<tr><td>' . $row['Prop_dia'] . '</td><td>' . $row['Prop_vin'] . '</td><td><input type="radio" name="propellSelected" value="' . $thisPropell . '"></td>';
                    }
                    echo '</table><div id="tableButtons"><input type="reset" value="Avbryt" id="cancelChoice" onclick="openPropellTable()"><input type="submit" value="Velg" id="chooseThis"></form></div></div></div><br>';

                    //BATTERIBATTERIBATTERI
                    $batteriAdvQuery = "SELECT * FROM batteri WHERE BatteriID=" . $IDval['BatteriID'];
                    $batteriAdvResult = mysqli_query($con, $batteriAdvQuery);
                    $batteriRow = mysqli_fetch_array($batteriAdvResult);
                    echo '<div id="component">';
                    echo '<div id="componentHead">BATTERI<br></div>';
                    echo '<div id="mainComponent">' . $batteriRow['Celler'] . 'S ';
                    echo $batteriRow['mah'] . 'mah ';
                    echo $batteriRow['C_max'] . 'C</div>';
                    echo '<div id="configstats">mah: <div id="pureStat">&nbsp' . $batteriRow['mah'] . '&nbsp</div></div>';
                    echo '</form>';
                    echo '<input type="button" id="dynamicBatteriTable" onclick="openBatteriTable()" style="display:block;" value="BYTT BATTERI">';
                    echo '<div id="batteriTable" style="display:none;"><table><br>';
                    echo '<tr><td><b>Celler</td><td><b>C_max</td><td><b>mah</td><td></td></tr>';
                    $batteriAdvInvQuery = "SELECT * FROM batteri WHERE BatteriID != " . $IDval['BatteriID'];
                    $batteriAdvInv = mysqli_query($con, $batteriAdvInvQuery);
                    echo '<form method="GET">';
                    while ($row = mysqli_fetch_array($batteriAdvInv)) {
                        $thisBatteri = $row['BatteriID'];
                        echo '<tr><td>' . $row['Celler'] . '</td><td>' . $row['C_max'] . '</td><td>' . $row['mah'] . '</td><td><input type="radio" name="batteriSelected" value="' . $thisBatteri . '"></td>';
                    }
                    echo '</table><div id="tableButtons"><input type="reset" value="Avbryt" id="cancelChoice" onclick="openBatteriTable()"><input type="submit" value="Velg" id="chooseThis"></form></div></div></div><br>';
                    
                    mysqli_close($con);
                    ?>
                    
                <a href="resultat.php"><button id="finishButton" type="button">FULLFØR</button></a>
            </div>  
            <div id="yoyo">fjudswaehfgudews ghyuewrhgfuewg ewgu9ew hguewr gewu9g ewhug ewug ewug ewrguew guerw guewi gweug egw egu we gewug ewgewug weug ewug </div>
        </div>
        <script type="text/javascript" src="banana.js"></script>
    </body>
</html>


