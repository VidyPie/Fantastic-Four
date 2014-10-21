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
                    echo '<div id="configMagic"><p>Komponenter</p>';
                    $testVar = $_SESSION['motorSelected'];
                    echo $testVar;

                    $motorID = $_SESSION['motorSelected'];
                    $propellID = $_SESSION['propellSelected'];
                    $batteriID = $_SESSION['batteriSelected'];
                    $kontrollBrettID = $_SESSION['kontrollBrettSelected'];
                    $ESCID = $_SESSION['ESCSelected'];

                    $tableInsertQuery =   "INSERT INTO nyttkopter ( `nyID`, `MotorID`, `BatteriID`, `KontrollbrettID`, `PropellID`, `ESCID` ) VALUES ( 1," 
                        . $motorID . "," . $batteriID . "," . $kontrollBrettID . "," . $propellID . "," . $ESCID . ");";
                    
                    mysqli_query($con, $tableInsertQuery);

                    $motorquery = "SELECT `Navn` FROM motor WHERE MotorID=" . $motorID;
                    $chosenMotor = mysqli_query($con, $motorquery);
                        echo '<select name="motordropdown">';
                        while ($row = mysqli_fetch_array($chosenMotor)){
                            $godName = $row['Navn'];
                            echo '<option value="0">' . $godName . '</option>';
                        }
                        $query = "SELECT * FROM motor WHERE MotorID !=" . $motorID;
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $nameResult = $row['Navn'];
                            $idResult = $row['MotorID'];
                            echo '<option value="' . $idResult . '">' . $nameResult . '</option>';
                        }
                        echo '</select><br>';

                        $motorKVQuery = "SELECT `kV` FROM motor WHERE MotorID=" . $motorID;
                        $motorKV = mysqli_query($con, $motorKVQuery);

                        $chosenMotor2 = mysqli_query($con, $motorquery);
                        echo '<div id="mainComponent">' . $chosenMotor2->fetch_object()->Navn . '</div>';    
                        echo '<div id="configstats">kV <div id="pureStat">&nbsp' . $motorKV->fetch_object()->kV . '&nbsp</div></div>';
                        


  
                   
                       if (isset($_POST['button1'])) 
                        { 
                            $con = $_SESSION['connection'];
                            $extSequence = "DELETE FROM nyttkopter WHERE nyID = 1;";
                            mysqli_query($con, $extSequence);
                            echo '<div id="exterminate">TABLE nyttkopter in DB kopterbygger is cleared!</div>'; 
                        }

                
                echo '</form>';
                echo '<p id="dynamicTable" onclick="openMotorTable()">CLICK</p>';
                echo '<table id="motorTable" style="display:none;">';
                echo '<tr><td>Navn</td><td>kV</td><td>Pris</td><td></td></tr>';
                        $compMotorQuery = "SELECT * FROM motor WHERE MotorID != " . $motorID;  
                        $result = mysqli_query($con, $compMotorQuery);
                        while ($row = mysqli_fetch_array($result)) {
                            $thisMotor = $row['MotorID'];
                            echo print($thisMotor); 
                            echo '<br>';

                            echo '<tr><td>' . $row['Navn'] . '</td><td>' . $row['kV'] . '</td><td>' . $row['Pris'] . '</td><td><button onclick="motorSelected(';
                            echo print($thisMotor);
                            echo ')">Velg</button></td>';
                            }  
                            mysqli_close($con);
                    ?>
                </table>
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

                        function pageRefresh() {
                            location.reload(true);
                        }

                        function motorSelected(thisMotor2) {
                            var thisMotorJS = ((thisMotor2 - 1) / 10);
                            var xmlhttp=new XMLHttpRequest();
                            xmlhttp.open("GET","data.php?q="+thisMotorJS,true);
                            xmlhttp.send();
                            //<?php 
                                //$con = $_SESSION['connection'];
                                //$thisMotorPHP = 10;
                                //$thisMotorPHP = $get['thisMotorJS'];
                                //$getNewMotorQuery = "SELECT * FROM motor WHERE MotorID = " . $_GET['thisMotorJS'];
                                //$getNewMotorQuery = "SELECT * FROM motor WHERE MotorID = " . $thisMotorPHP;
                                //$_SESSION['motorSelected'] = $_GET['thisMotorJS'];
                                //$_SESSION['motorSelected'] = mysqli_query($con, $getNewMotorQuery);
                                //mysqli_close($con);
                            //?>
                                pageRefresh();
                            }
                        

                </script>

    </body>
</html>


