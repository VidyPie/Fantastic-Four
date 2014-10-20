<?php
session_start();


if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == FALSE) {
    header('Location: login.php');
}

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

                    $motorID = $_SESSION['motorSelected'];
                    $propellID = $_SESSION['propellSelected'];
                    $batteriID = $_SESSION['batteriSelected'];
                    $kontrollBrettID = $_SESSION['kontrollBrettSelected'];
                    $ESCID = $_SESSION['ESCSelected'];

                    $tableInsertQuery = "INSERT INTO `nyttkopter` ( `nyID`, `MotorID`, `BatteriID`, `KontrollbrettID`, `PropellID`, `ESCID` ) VALUES ( 1," 
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

                       if (isset($_POST['button1'])) 
                        { 
                            $con = $_SESSION['connection'];
                            $extSequence = "DELETE FROM nyttkopter WHERE nyID = 1;";
                            mysqli_query($con, $extSequence);
                            echo '<div id="exterminate">TABLE nyttkopter in DB kopterbygger is cleared!</div>'; 
                        }

                     mysqli_close($con);   
                ?>
                </form>
                <form id="eButton" method="POST" action=''>
                    <input type="submit" name="button1"  value="Exterminate">
                </form>
            </div>
        </div>
    </body>
</html>
