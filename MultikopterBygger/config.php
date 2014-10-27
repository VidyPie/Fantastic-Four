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
                    //echo '<div id="configMagic"><p>Komponenter</p>';

                   // $oID = $_GET['c'];

                    $motorID = $_SESSION['motorSelected'];
                    $propellID = $_SESSION['propellSelected'];
                    $batteriID = $_SESSION['batteriSelected'];
                    $kontrollbrettID = $_SESSION['kontrollBrettSelected'];
                    $ESCID = $_SESSION['ESCSelected'];

                    if(isset($_GET['motorSelected'])) {
                        $motorID = $_GET['motorSelected'];
                    }
                    if(isset($_GET['ESCSelected'])) {
                        $ESCID = $_GET['ESCSelected'];
                    }
                    if(isset($_GET['kontrollbrettSelected'])) {
                        $kontrollbrettID = $_GET['kontrollbrettSelected'];
                    }
                    if(isset($_GET['propellSelected'])) {
                        $propellID = $_GET['propellSelected'];
                    }
                    if(isset($_GET['batteriSelected'])) {
                        $batteriID = $_GET['batteriSelected'];
                    }

                    echo print($motorID);
                        //MOTORMOTORMOTOR
                        $motorAdvQuery = "SELECT * FROM motor WHERE MotorID=" . $motorID;
                        $motorAdvResult = mysqli_query($con, $motorAdvQuery);
                        $motorRow = mysqli_fetch_array($motorAdvResult);
                        echo '<div id="mainComponent">' . $motorRow['Navn'] . '</div>';  
                        echo '<div id="configstats">kV <div id="pureStat">&nbsp' . $motorRow['kV'] . '&nbsp</div></div>';
                        echo '<div id="configstats">Amps <div id="pureStat">&nbsp' . $motorRow['Amps'] . '&nbsp</div></div>';
                        echo '<div id="configstats">Pris <div id="pureStat">&nbsp' . $motorRow['Pris'] . '&nbsp</div></div>';
                        echo '<p id="dynamicTable" onclick="openMotorTable()">BYTT MOTOR</p>';
                        echo '<div id="motorTable" style="display:none;"><table>';
                        echo '<tr><td>Navn</td><td>kV</td><td>Amps</td><td>Pris</td><td></td></tr>';
                        $motorAdvInvQuery = "SELECT * FROM motor WHERE MotorID != " . $motorID;  
                        $motorAdvInv = mysqli_query($con, $motorAdvInvQuery);
                        while ($row = mysqli_fetch_array($motorAdvInv)) {
                            $thisMotor = $row['MotorID'];
                            echo '<tr><td>' . $row['Navn'] . '</td><td>' . $row['kV'] . '</td><td>' . $row['Amps'] . '</td><td>' . $row['Pris'] . '</td><td><input type="radio" name="motorSelected" value="' . $thisMotor . '"></td>';
                            }  
                        echo '</form></table><input type="submit" value="Velg"></div><br>';

                        //ESCESCESC
                        $ESCAdvQuery = 'SELECT * FROM esc WHERE ESCID= ' . $ESCID;
                        $ESCAdvResult = mysqli_query($con, $ESCAdvQuery);
                        $ESCRow = mysqli_fetch_array($ESCAdvResult);
                        echo '<div id="mainComponent">' . $ESCRow['Navn'] . '</div>';
                        echo '<div id="configstats">Ampere <div id="pureStat">&nbsp' . $ESCRow['Ampere'] . '&nbsp</div></div>';
                        echo '<div id="configstats">Pris <div id="pureStat">&nbsp' . $ESCRow['Pris'] . '&nbsp</div></div>'; 
                        echo '<p id="dynamicTable" onclick="openESCTable()">BYTT ESC</p>';
                        echo '<div id="ESCTable" style="display:none;"><table>';
                        echo '<tr><td>Navn</td><td>Ampere</td><td>Pris</td><td></td></tr>';
                        $ESCAdvInvQuery = "SELECT * FROM esc WHERE ESCID != " . $ESCID;  
                        $ESCAdvInv = mysqli_query($con, $ESCAdvInvQuery);
                        while ($row = mysqli_fetch_array($ESCAdvInv)) {
                            $thisESC = $row['ESCID'];
                            echo '<tr><td>' . $row['Navn'] . '</td><td>' . $row['Ampere'] . '</td><td>' . $row['Pris'] . '</td><td><input type="radio" name="ESCSelected" value="' . $thisESC . '"></td>';
                            }
                        echo '</form></table><input type="submit" value="Velg"></div><br>';

                        //KONTROLLBRETTKONTROLLBRETTKONTROLLBRETT
                        $kontrollbrettAdvQuery = 'SELECT * FROM kontrollbrett WHERE KontrollbrettID= ' . $kontrollbrettID;
                        $kontrollbrettAdvResult = mysqli_query($con, $kontrollbrettAdvQuery);
                        $kontrollbrettRow = mysqli_fetch_array($kontrollbrettAdvResult);
                        echo '<div id="mainComponent">' . $kontrollbrettRow['Navn'] . '</div>';  
                        echo '<div id="configstats">Min. Rotor <div id="pureStat">&nbsp' . $kontrollbrettRow['Rotor_min'] . '&nbsp</div></div>';
                        echo '<div id="configstats">Max. Rotor <div id="pureStat">&nbsp' . $kontrollbrettRow['Rotor_max'] . '&nbsp</div></div><br>';
                        echo '<div id="configstats">GPS <div id="pureStat">&nbsp' . $kontrollbrettRow['GPS'] . '&nbsp</div></div>'; 
                        echo '<div id="configstats">Pris <div id="pureStat">&nbsp' . $kontrollbrettRow['Pris'] . '&nbsp</div></div>'; 
                        echo '<p id="dynamicTable" onclick="openKontrollbrettTable()">BYTT KONTROLLBRETT</p>';
                        echo '<div id="kontrollbrettTable" style="display:none;"><table>';
                        echo '<tr><td>Navn</td><td>Min. Rotor</td><td>Max. Rotor</td><td>GPS</td><td>Pris</td><td></td></tr>';
                        $kontrollbrettAdvInvQuery = "SELECT * FROM kontrollbrett WHERE KontrollbrettID != " . $kontrollbrettID;  
                        $kontrollbrettAdvInv = mysqli_query($con, $kontrollbrettAdvInvQuery);
                        while ($row = mysqli_fetch_array($kontrollbrettAdvInv)) {
                            $thisKontrollbrett = $row['KontrollbrettID']; 
                            echo '<tr><td>' . $row['Navn'] . '</td><td>' . $row['Rotor_min'] . '</td><td>' . $row['Rotor_max'] . '</td><td>' . $row['GPS'] .'</td><td>' . $row['Pris'] . '</td><td><input type="radio" name="kontrollbrettSelected" value="' . $thisKontrollbrett . '"></td>';
                            }
                        echo '</form></table><input type="submit" value="Velg"></div><br>';

                        //PROPELLPROPELLPROPELL
                        $propellAdvQuery = 'SELECT * FROM propeller WHERE propellID= ' . $propellID;
                        $propellAdvResult = mysqli_query($con, $propellAdvQuery);
                        $propellRow = mysqli_fetch_array($propellAdvResult);
                        echo '<div id="mainComponent">' . $propellRow['Prop_dia'] . '"x';
                        echo $propellRow['Prop_vin'] . ' propeller</div>';   
                        echo '<div id="configstats">Diameter <div id="pureStat">&nbsp' . $propellRow['Prop_dia'] . '&nbsp</div></div>';
                        echo '<div id="configstats">Vinkling <div id="pureStat">&nbsp' . $propellRow['Prop_vin'] . '&nbsp</div></div>'; 
                        echo '<p id="dynamicTable" onclick="openPropellTable()">BYTT PROPELLER</p>';
                        echo '<div id="propellTable" style="display:none;"><table>';
                        echo '<tr><td>Diameter</td><td>Vinkling</td><td></td></tr>';
                        $propellAdvInvQuery = "SELECT * FROM propeller WHERE propellID != " . $propellID;  
                        $propellAdvInv = mysqli_query($con, $propellAdvInvQuery);
                        while ($row = mysqli_fetch_array($propellAdvInv)) {
                            $thisPropell = $row['PropellID']; 
                            echo '<tr><td>' . $row['Prop_dia'] . '</td><td>' . $row['Prop_vin'] . '</td><td><input type="radio" name="propellSelected" value="' . $thisPropell . '"></td>';
                            }
                        echo '</form></table><input type="submit" value="Velg"></div><br>';

                        //BATTERIBATTERIBATTERI
                        $batteriAdvQuery = "SELECT * FROM batteri WHERE BatteriID=" . $batteriID;
                        $batteriAdvResult = mysqli_query($con, $batteriAdvQuery);
                        $batteriRow = mysqli_fetch_array($batteriAdvResult);
                        echo '<div id="mainComponent">' . $batteriRow['Celler'] . 'S ';
                        echo $batteriRow['mah'] . 'mah ';
                        echo $batteriRow['C_max'] . 'C</div>';    
                        echo '<div id="configstats">mah <div id="pureStat">&nbsp' . $batteriRow['mah'] . '&nbsp</div></div>';
                        echo '<div id="configstats">Pris <div id="pureStat">&nbsp' . $batteriRow['Pris'] . '&nbsp</div></div>';
                        echo '</form>';
                        echo '<p id="dynamicTable" onclick="openBatteriTable()">BYTT BATTERI</p>';
                        echo '<div id="batteriTable" style="display:none;"><table>';
                        echo '<tr><td>Celler</td><td>C_max</td><td>mah</td><td>Pris</td><td></td></tr>';
                        $batteriAdvInvQuery = "SELECT * FROM batteri WHERE BatteriID != " . $batteriID;  
                        $batteriAdvInv = mysqli_query($con, $batteriAdvInvQuery);
                        while ($row = mysqli_fetch_array($batteriAdvInv)) {
                            $thisBatteri = $row['BatteriID'];
                            echo '<tr><td>' . $row['Celler'] . '</td><td>' . $row['C_max'] . '</td><td>' . $row['mah'] . '</td><td>' . $row['Pris'] . '</td><td><input type="radio" name="batteriSelected" value="' . $thisBatteri . '"></td>';
                            }  
                        echo '</form></table><input type="submit" value="Velg"></div><br>';


                        mysqli_close($con);
                        ?>
                        </div>  
                </div>
                    <script type="text/javascript" language="javascript">
                        function openMotorTable() {
                            var motorTable = document.getElementById("motorTable");
                            var motorselected = document.getElementById("motorselected");
                            if (motorTable.style.display == "none"){
                                motorTable.style.display = "block";
                                ESCTable.style.display = "none";
                                kontrollbrettTable.style.display = "none";
                                batteriTable.style.display = "none";
                                propellTable.style.display = "none";

                                propellselected.style.display="none";
                                batteriselected.style.display = "none";
                                escselected.style.display="none";
                                kontrollbrettselected.style.display="none";
                                motorselected.style.display="block";
                            }
                            else{
                                motorTable.style.display = "none";
                                motorselected.style.display="none";
                            }
                        }

                        function openESCTable() {
                            var ESCTable = document.getElementById("ESCTable");
                            var escselected = document.getElementById("escselected");
                            if (ESCTable.style.display == "none"){
                                ESCTable.style.display = "block";
                                motorTable.style.display = "none";
                                kontrollbrettTable.style.display = "none";
                                batteriTable.style.display = "none";
                                propellTable.style.display = "none";

                                propellselected.style.display="none";
                                batteriselected.style.display = "none";
                                escselected.style.display="block";
                                kontrollbrettselected.style.display="none";
                                motorselected.style.display="none";
                            }
                            else{
                                ESCTable.style.display = "none";
                                escselected.style.display="none";
                            }
                        }

                        function openKontrollbrettTable() {
                            var kontrollbrettTable = document.getElementById("kontrollbrettTable");
                            var kontrollbrettselected = document.getElementById("kontrollbrettselected");
                            if (kontrollbrettTable.style.display == "none"){
                                kontrollbrettTable.style.display = "block";
                                ESCTable.style.display = "none";
                                motorTable.style.display = "none";
                                batteriTable.style.display = "none";
                                propellTable.style.display = "none";

                                propellselected.style.display="none";
                                batteriselected.style.display = "none";
                                escselected.style.display="none";
                                kontrollbrettselected.style.display="block";
                                motorselected.style.display="none";
                            }
                            else{
                                kontrollbrettTable.style.display = "none";
                                kontrollbrettselected.style.display="none";
                            }
                        }

                        function openPropellTable() {
                            var propellTable = document.getElementById("propellTable");
                            var propellselected = document.getElementById("propellselected");
                            if (propellTable.style.display == "none"){
                                propellTable.style.display = "block";
                                ESCTable.style.display = "none";
                                kontrollbrettTable.style.display = "none";
                                batteriTable.style.display = "none";
                                motorTable.style.display = "none";

                                propellselected.style.display="block";
                                batteriselected.style.display = "none";
                                escselected.style.display="none";
                                kontrollbrettselected.style.display="none";
                                motorselected.style.display="none";
                            }
                            else{
                                propellTable.style.display = "none";
                                propellselected.style.display="none";
                            }
                        }

                        function openBatteriTable() {
                            var batteriTable = document.getElementById("batteriTable");
                            var batteriselected = document.getElementById("batteriselected");
                            if (batteriTable.style.display == "none"){
                                batteriTable.style.display = "block";
                                ESCTable.style.display = "none";
                                kontrollbrettTable.style.display = "none";
                                motorTable.style.display = "none";
                                propellTable.style.display = "none";

                                propellselected.style.display="none";
                                batteriselected.style.display = "block";
                                escselected.style.display="none";
                                kontrollbrettselected.style.display="none";
                                motorselected.style.display="none";
                            }
                            else{
                                batteriTable.style.display = "none";
                                batteriselected.style.display = "none";
                            }
                        }

                        

                </script>

    </body>
</html>


