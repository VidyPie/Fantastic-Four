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
                <form name="components2" method="POST">
                    <?php
                    $con = $_SESSION['connection'];
                    echo '<div id="configMagic">';
                    //echo '<div id="configMagic"><p>Komponenter</p>';

                    $motorID = $_SESSION['motorSelected'];
                    $propellID = $_SESSION['propellSelected'];
                    $batteriID = $_SESSION['batteriSelected'];
                    $kontrollbrettID = $_SESSION['kontrollBrettSelected'];
                    $ESCID = $_SESSION['ESCSelected'];


                        //MOTORMOTORMOTOR
                        $motorAdvQuery = "SELECT * FROM motor WHERE MotorID=" . $motorID;
                        $motorAdv = mysqli_query($con, $motorAdvQuery);
                        echo '<div id="mainComponent">' . $motorAdv->fetch_object()->Navn . '</div>'; 
                        $motorAdv = mysqli_query($con, $motorAdvQuery);   
                        echo '<div id="configstats">kV <div id="pureStat">&nbsp' . $motorAdv->fetch_object()->kV . '&nbsp</div></div>';
                        $motorAdv = mysqli_query($con, $motorAdvQuery);
                        echo '<div id="configstats">Amps <div id="pureStat">&nbsp' . $motorAdv->fetch_object()->Amps . '&nbsp</div></div>';
                        $motorAdv = mysqli_query($con, $motorAdvQuery);
                        echo '<div id="configstats">Pris <div id="pureStat">&nbsp' . $motorAdv->fetch_object()->Pris . '&nbsp</div></div>';
                        echo '</form>';
                        echo '<p id="dynamicTable" onclick="openMotorTable()">BYTT MOTOR</p>';
                        echo '<table id="motorTable" style="display:none;">';
                        echo '<tr><td>Navn</td><td>kV</td><td>Amps</td><td>Pris</td><td></td></tr>';
                        $motorAdvInvQuery = "SELECT * FROM motor WHERE MotorID != " . $motorID;  
                        $motorAdvInv = mysqli_query($con, $motorAdvInvQuery);
                        while ($row = mysqli_fetch_array($motorAdvInv)) {
                            $thisMotor = $row['MotorID'];
                            echo '<tr><td>' . $row['Navn'] . '</td><td>' . $row['kV'] . '</td><td>' . $row['Amps'] . '</td><td>' . $row['Pris'] . '</td><td><button onclick="motorSelected(';
                            echo print($thisMotor);
                            echo ')">Velg</button></td>';
                            }  
                        echo '</table><br>';

                        //ESCESCESC
                        $ESCAdvQuery = 'SELECT * FROM esc WHERE ESCID= ' . $ESCID;
                        $ESCAdv = mysqli_query($con, $ESCAdvQuery);
                        echo '<div id="mainComponent">' . $ESCAdv->fetch_object()->Navn . '</div>';
                        $ESCAdv = mysqli_query($con, $ESCAdvQuery);
                        echo '<div id="configstats">Ampere <div id="pureStat">&nbsp' . $ESCAdv->fetch_object()->Ampere . '&nbsp</div></div>';
                        $ESCAdv = mysqli_query($con, $ESCAdvQuery);
                        echo '<div id="configstats">Pris <div id="pureStat">&nbsp' . $ESCAdv->fetch_object()->Pris . '&nbsp</div></div>'; 
                        echo '</form>';
                        echo '<p id="dynamicTable" onclick="openESCTable()">BYTT ESC</p>';
                        echo '<table id="ESCTable" style="display:none;">';
                        echo '<tr><td>Navn</td><td>Ampere</td><td>Pris</td><td></td></tr>';
                        $ESCAdvInvQuery = "SELECT * FROM esc WHERE ESCID != " . $ESCID;  
                        $ESCAdvInv = mysqli_query($con, $ESCAdvInvQuery);
                        while ($row = mysqli_fetch_array($ESCAdvInv)) {
                            $thisESC = $row['ESCID'];
                            echo '<tr><td>' . $row['Navn'] . '</td><td>' . $row['Ampere'] . '</td><td>' . $row['Pris'] . '</td><td><button onclick="ESCSelected(';
                            echo print($thisESC);
                            echo ')">Velg</button></td>';
                            }
                        echo '</table><br>';

                        //KONTROLLBRETTKONTROLLBRETTKONTROLLBRETT
                        $kontrollbrettAdvQuery = 'SELECT * FROM kontrollbrett WHERE KontrollbrettID= ' . $kontrollbrettID;
                        $kontrollbrettAdv = mysqli_query($con, $kontrollbrettAdvQuery);
                        echo '<div id="mainComponent">' . $kontrollbrettAdv->fetch_object()->Navn . '</div>';
                        $kontrollbrettAdv = mysqli_query($con, $kontrollbrettAdvQuery);   
                        echo '<div id="configstats">Min. Rotor <div id="pureStat">&nbsp' . $kontrollbrettAdv->fetch_object()->Rotor_min . '&nbsp</div></div>';
                        $kontrollbrettAdv = mysqli_query($con, $kontrollbrettAdvQuery);
                        echo '<div id="configstats">Max. Rotor <div id="pureStat">&nbsp' . $kontrollbrettAdv->fetch_object()->Rotor_max . '&nbsp</div></div><br>';
                        $kontrollbrettAdv = mysqli_query($con, $kontrollbrettAdvQuery);
                        echo '<div id="configstats">GPS <div id="pureStat">&nbsp' . $kontrollbrettAdv->fetch_object()->GPS . '&nbsp</div></div>'; 
                        $kontrollbrettAdv = mysqli_query($con, $kontrollbrettAdvQuery);
                        echo '<div id="configstats">Pris <div id="pureStat">&nbsp' . $kontrollbrettAdv->fetch_object()->Pris . '&nbsp</div></div>'; 
                        echo '</form>';
                        echo '<p id="dynamicTable" onclick="openKontrollbrettTable()">BYTT KONTROLLBRETT</p>';
                        echo '<table id="kontrollbrettTable" style="display:none;">';
                        echo '<tr><td>Navn</td><td>Min. Rotor</td><td>Max. Rotor</td><td>GPS</td><td>Pris</td><td></td></tr>';
                        $kontrollbrettAdvInvQuery = "SELECT * FROM kontrollbrett WHERE KontrollbrettID != " . $kontrollbrettID;  
                        $kontrollbrettAdvInv = mysqli_query($con, $kontrollbrettAdvInvQuery);
                        while ($row = mysqli_fetch_array($kontrollbrettAdvInv)) {
                            $thisKontrollbrett = $row['KontrollbrettID']; 
                            //echo '<br>';
                            echo '<tr><td>' . $row['Navn'] . '</td><td>' . $row['Rotor_min'] . '</td><td>' . $row['Rotor_max'] . '</td><td>' . $row['GPS'] .'</td><td>' . $row['Pris'] . '</td><td><button onclick="kontrollbrettSelected(';
                            echo print($thisKontrollbrett);
                            echo ')">Velg</button></td>';
                            }
                        echo '</table><br>';

                        //PROPELLPROPELLPROPELL
                        $propellAdvQuery = 'SELECT * FROM propeller WHERE propellID= ' . $propellID;
                        $propellAdv = mysqli_query($con, $propellAdvQuery);
                        echo '<div id="mainComponent">' . $propellAdv->fetch_object()->Prop_dia . '"x';
                        $propellAdv = mysqli_query($con, $propellAdvQuery); 
                        echo $propellAdv->fetch_object()->Prop_vin . ' propeller</div>';
                        $propellAdv = mysqli_query($con, $propellAdvQuery);   
                        echo '<div id="configstats">Diameter <div id="pureStat">&nbsp' . $propellAdv->fetch_object()->Prop_dia . '&nbsp</div></div>';
                        $propellAdv = mysqli_query($con, $propellAdvQuery);
                        echo '<div id="configstats">Vinkling <div id="pureStat">&nbsp' . $propellAdv->fetch_object()->Prop_vin . '&nbsp</div></div>'; 
                        echo '</form>';
                        echo '<p id="dynamicTable" onclick="openPropellTable()">BYTT PROPELLER</p>';
                        echo '<table id="propellTable" style="display:none;">';
                        echo '<tr><td>Diameter</td><td>Vinkling</td><td></td></tr>';
                        $propellAdvInvQuery = "SELECT * FROM propeller WHERE propellID != " . $propellID;  
                        $propellAdvInv = mysqli_query($con, $propellAdvInvQuery);
                        while ($row = mysqli_fetch_array($propellAdvInv)) {
                            $thisPropell = $row['PropellID']; 
                            echo '<tr><td>' . $row['Prop_dia'] . '</td><td>' . $row['Prop_vin'] . '</td><td><button onclick="propellSelected(';
                            echo print($thisPropell);
                            echo ')">Velg</button></td>';
                            }
                        echo '</table><br>';

                        //BATTERIBATTERIBATTERI
                        $batteriAdvQuery = "SELECT * FROM batteri WHERE BatteriID=" . $batteriID;
                        $batteriAdv = mysqli_query($con, $batteriAdvQuery);
                        echo '<div id="mainComponent">' . $batteriAdv->fetch_object()->Celler . 'S ';
                        $batteriAdv = mysqli_query($con, $batteriAdvQuery);
                        echo $batteriAdv->fetch_object()->mah . 'mah ';
                        $batteriAdv = mysqli_query($con, $batteriAdvQuery);
                        echo $batteriAdv->fetch_object()->C_max . 'C</div>';  
                        $batteriAdv = mysqli_query($con, $batteriAdvQuery);   
                        echo '<div id="configstats">mah <div id="pureStat">&nbsp' . $batteriAdv->fetch_object()->mah . '&nbsp</div></div>';
                        $batteriAdv = mysqli_query($con, $batteriAdvQuery);
                        echo '<div id="configstats">Pris <div id="pureStat">&nbsp' . $batteriAdv->fetch_object()->Pris . '&nbsp</div></div>';
                        echo '</form>';
                        echo '<p id="dynamicTable" onclick="openBatteriTable()">BYTT BATTERI</p>';
                        echo '<table id="batteriTable" style="display:none;">';
                        echo '<tr><td>Celler</td><td>C_max</td><td>mah</td><td>Pris</td><td></td></tr>';
                        $batteriAdvInvQuery = "SELECT * FROM batteri WHERE BatteriID != " . $batteriID;  
                        $batteriAdvInv = mysqli_query($con, $batteriAdvInvQuery);
                        while ($row = mysqli_fetch_array($batteriAdvInv)) {
                            $thisBatteri = $row['BatteriID'];
                            echo '<tr><td>' . $row['Celler'] . '</td><td>' . $row['C_max'] . '</td><td>' . $row['mah'] . '</td><td>' . $row['Pris'] . '</td><td><button onclick="batteriSelected(';
                            echo print($thisBatteri);
                            echo ')">Velg</button></td>';
                            }  
                        echo '</table>';
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

                        function motorSelected(thisMotor2) {
                            var thisMotorJS = ((thisMotor2 - 1) / 10);
                            var xmlhttp=new XMLHttpRequest();
                            xmlhttp.open("GET","configMotor.php?q="+thisMotorJS,true);
                            xmlhttp.send();
                            pageRefresh();
                        }

                        function ESCSelected(thisESC2) {
                            var thisESCJS = ((thisESC2 - 1) / 10);
                            var xmlhttp=new XMLHttpRequest();
                            xmlhttp.open("GET","configESC.php?q="+thisESCJS,true);
                            xmlhttp.send();
                            pageRefresh();
                        }

                        function kontrollbrettSelected(thisKontrollbrett2) {
                            var thisKontrollbrettJS = ((thisKontrollbrett2 - 1) / 10);
                            var xmlhttp=new XMLHttpRequest();
                            xmlhttp.open("GET","configKontrollbrett.php?q="+thisKontrollbrettJS,true);
                            xmlhttp.send();
                            pageRefresh();
                        }

                        function propellSelected(thisPropell2) {
                            var thisPropellJS = ((thisPropell2 - 1) / 10);
                            var xmlhttp=new XMLHttpRequest();
                            xmlhttp.open("GET","configPropell.php?q="+thisPropellJS,true);
                            xmlhttp.send();
                            pageRefresh();
                        }

                        function batteriSelected(thisBatteri2) {
                            var thisBatteriJS = ((thisBatteri2 - 1) / 10);
                            var xmlhttp=new XMLHttpRequest();
                            xmlhttp.open("GET","configBatteri.php?q="+thisBatteriJS,true);
                            xmlhttp.send();
                            pageRefresh();
                        }


                        function pageRefresh() {
                                sleep(100);
                                location.reload(true);
                        }

                        function sleep(milliseconds) {
                            var start = new Date().getTime();
                            for (var i = 0; i < 1e7; i++) {
                                if ((new Date().getTime() - start) > milliseconds){
                                    break;
                                }
                            }
                        }

                </script>

    </body>
</html>


