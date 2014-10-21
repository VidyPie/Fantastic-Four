<?php

session_start();

$host = "127.0.0.1";
$port = 3306;
$socket = "/tmp/mysql.sock";
$user = "user";
$password = "123";
$dbname = "kopterbygger";

$con=  mysqli_connect($host, $user, $password, $dbname, $port, $socket);

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
            <a href=index.html>
                <img class="banner" src="main_styling/banner.png" alt ="Kopterbygger">
            </a>
            <a href=index.html>
                <img class="extension" src="main_styling/bannerext.png" alt="graybox">
            </a>
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
                    $kontrollBrettID = $_SESSION['kontrollBrettSelected'];
                    $ESCID = $_SESSION['ESCSelected'];

                    echo $motorID;

                    $tableInsertQuery =   "INSERT INTO nyttkopter ( `nyID`, `MotorID`, `BatteriID`, `KontrollbrettID`, `PropellID`, `ESCID` ) VALUES ( 1," 
                        . $motorID . "," . $batteriID . "," . $kontrollBrettID . "," . $propellID . "," . $ESCID . ");";
                    
                    mysqli_query($con, $tableInsertQuery);

                        //MOTORMOTORMOTOR
                        $motorquery = "SELECT `Navn` FROM motor WHERE MotorID=" . $motorID;
                        $chosenMotor = mysqli_query($con, $motorquery);
                        $query = "SELECT * FROM motor WHERE MotorID !=" . $motorID;
                        $result = mysqli_query($con, $query);
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
                        echo '<p id="dynamicTable" onclick="openMotorTable()">CLICK</p>';
                        echo '<table id="motorTable" style="display:none;">';
                        echo '<tr><td>Navn</td><td>kV</td><td>Pris</td><td></td></tr>';
                        $motorAdvInvQuery = "SELECT * FROM motor WHERE MotorID != " . $motorID;  
                        $motorAdvInv = mysqli_query($con, $motorAdvInvQuery);
                        while ($row = mysqli_fetch_array($motorAdvInv)) {
                            $thisMotor = $row['MotorID'];
                            echo print($thisMotor); 
                            echo '<br>';

                            echo '<tr><td>' . $row['Navn'] . '</td><td>' . $row['kV'] . '</td><td>' . $row['Pris'] . '</td><td><button onclick="motorSelected(';
                            echo print($thisMotor);
                            echo ')">Velg</button></td>';
                            }  
                        echo '</table><br><br>';

                        //ESCESCESC
                        echo $ESCID;
                        $ESCAdvQuery = 'SELECT * FROM esc WHERE ESCID= ' . $ESCID;
                        $ESCAdv = mysqli_query($con, $ESCAdvQuery);
                        echo '<div id="mainComponent">' . $ESCAdv->fetch_object()->Navn . '</div>';
                        $ESCAdv = mysqli_query($con, $ESCAdvQuery);
                        echo '<div id="configstats">Ampere <div id="pureStat">&nbsp' . $ESCAdv->fetch_object()->Ampere . '&nbsp</div></div>';
                        $ESCAdv = mysqli_query($con, $ESCAdvQuery);
                        echo '<div id="configstats">Pris <div id="pureStat">&nbsp' . $ESCAdv->fetch_object()->Pris . '&nbsp</div></div>'; 
                        echo '</form>';
                        echo '<p id="dynamicTable" onclick="openESCTable()">CLICK</p>';
                        echo '<table id="ESCTable" style="display:none;">';
                        echo '<tr><td>Navn</td><td>kV</td><td>Pris</td><td></td></tr>';
                        $ESCAdvInvQuery = "SELECT * FROM esc WHERE ESCID != " . $ESCID;  
                        $ESCAdvInv = mysqli_query($con, $ESCAdvInvQuery);
                        while ($row = mysqli_fetch_array($ESCAdvInv)) {
                            $thisESC = $row['ESCID'];
                            echo print($thisESC); 
                            echo '<br>';
                            echo '<tr><td>' . $row['Navn'] . '</td><td>' . $row['Ampere'] . '</td><td>' . $row['Pris'] . '</td><td><button onclick="ESCSelected(';
                            echo print($thisESC);
                            echo ')">Velg</button></td>';
                            }
                        echo '</table><br><br>';

                        //PROPELLPROPELLPROPELL
                        echo $propellID;
                        $propellAdvQuery = 'SELECT * FROM propeller WHERE propellID= ' . $propellID;
                        $propellAdv = mysqli_query($con, $propellAdvQuery);
                        echo '<div id="mainComponent">' . $propellAdv->fetch_object()->Navn . '</div>';
                        $propellAdv = mysqli_query($con, $propellAdvQuery);   
                        echo '<div id="configstats">Diameter <div id="pureStat">&nbsp' . $propellAdv->fetch_object()->Prop_dia . '&nbsp</div></div>';
                        $propellAdv = mysqli_query($con, $propellAdvQuery);
                        echo '<div id="configstats">Vinkling <div id="pureStat">&nbsp' . $propellAdv->fetch_object()->Prop_vin . '&nbsp</div></div>';
                        $propellAdv = mysqli_query($con, $propellAdvQuery);
                        echo '<div id="configstats">Pris <div id="pureStat">&nbsp' . $propellAdv->fetch_object()->Pris . '&nbsp</div></div>'; 
                        echo '</form>';
                        echo '<p id="dynamicTable" onclick="openPropellTable()">CLICK</p>';
                        echo '<table id="propellTable" style="display:none;">';
                        echo '<tr><td>Navn</td><td>kV</td><td>Pris</td><td></td></tr>';
                        $propellAdvInvQuery = "SELECT * FROM propeller WHERE propellID != " . $propellID;  
                        $propellAdvInv = mysqli_query($con, $propellAdvInvQuery);
                        while ($row = mysqli_fetch_array($propellAdvInv)) {
                            $thisPropell = $row['PropellID'];
                            echo print($thisPropell); 
                            echo '<br>';
                            echo '<tr><td>' . $row['Navn'] . '</td><td>' . $row['Prop_dia'] . '</td><td>' . $row['Prop_vin'] . '</td><td>' . $row['Pris'] . '</td><td><button onclick="propellSelected(';
                            echo print($thisPropell);
                            echo ')">Velg</button></td>';
                            }
                        echo '</table><br><br>';


                        



                       if (isset($_POST['button1'])) 
                        { 
                            $con = $_SESSION['connection'];
                            $extSequence = "DELETE FROM nyttkopter WHERE nyID = 1;";
                            mysqli_query($con, $extSequence);
                            echo '<div id="exterminate">TABLE nyttkopter in DB kopterbygger is cleared!</div>'; 
                        }

mysqli_close($con);

                    ?>
                
                <form id="eButton" method="POST" action=''>
                    <input type="submit" name="button1"  value="Exterminate">
                </form>
            </div>
        </div>

<script type="text/javascript" language="javascript">
                        function openMotorTable() {
                            var motorTable = document.getElementById("motorTable");
                            if (motorTable.style.display == "none"){
                                motorTable.style.display = "block";
                            }
                            else{
                                motorTable.style.display = "none";
                            }
                        }

                        function openESCTable() {
                            var ESCTable = document.getElementById("ESCTable");
                            if (ESCTable.style.display == "none"){
                                ESCTable.style.display = "block";
                            }
                            else{
                                ESCTable.style.display = "none";
                            }
                        }

                        function openPropellTable() {
                            var propellTable = document.getElementById("propellTable");
                            if (propellTable.style.display == "none"){
                                propellTable.style.display = "block";
                            }
                            else{
                                propellTable.style.display = "none";
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
                            xmlhttp.open("GET","configESC.php?r="+thisESCJS,true);
                            xmlhttp.send();
                            pageRefresh();
                        }

                        function propellSelected(thisPropell2) {
                            var thisPropellJS = ((thisPropell2 - 1) / 10);
                            var xmlhttp=new XMLHttpRequest();
                            xmlhttp.open("GET","data.php?s="+thisPropellJS,true);
                            xmlhttp.send();
                            pageRefresh();
                        }


                        function pageRefresh() {
                            location.reload(true);
                        }
                </script>

    </body>
</html>


