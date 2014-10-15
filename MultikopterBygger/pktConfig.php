<?php
session_start();

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

        <div class="banner">
            <img class="banner" src="main_styling/banner.png" alt ="Kopterbygger">
            <img class="frametest" src="main_styling/frame.png" alt="frame">
        </div>

        <div class="frame">
            <div class="inframe_text">

                <form name="myform" action="" method="POST">
                    <div>
                            <?php
                            $con = $_SESSION['connection'];

                            echo '<select name="motordropdown">';
                            $query = "SELECT * FROM motor";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                $nameResult = $row['Navn'];
                                $idResult = $row['MotorID'];
                                echo '<option value="' . $idResult . '">' . $nameResult . '</option>';
                            }
                            echo '</select><br>';
                            
                            echo '<select name="escdropdown">';
                            $query = "SELECT * FROM esc";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                $nameResult = $row['Navn'];
                                $idResult = $row['ESCID'];
                                echo '<option value="' . $idResult . '">' . $nameResult . '</option>';
                            }
                            echo '</select><br>';
                            
                            echo '<select name="propdropdown">';
                            $query = "SELECT * FROM propeller";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                $nameResult = $row['Navn'];
                                $idResult = $row['PropellID'];
                                $diaResult = $row['Prop_dia'];
                                $vinResult = $row['Prop_vin'];
                                echo '<option value="' . $idResult . '">' . $nameResult 
                                        . ' ' . $diaResult . '"x' . $vinResult . '</option>';
                            }
                            echo '</select><br>';
                            
                            echo '<select name="kontrollbrettdropdown">';
                            $query = "SELECT * FROM kontrollbrett";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                $nameResult = $row['Navn'];
                                $idResult = $row['KontrollbrettID'];
                                echo '<option value="' . $idResult . '">' . $nameResult . '</option>';
                            }
                            echo '</select><br>';
                            
                            echo '<select name="batteridropdown">';
                            $query = "SELECT * FROM batteri";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                $mahResult = $row['mah'];
                                $cResult = $row['C_max'];
                                $sResult = $row['Celler'];
                                $idResult = $row['BatteriID'];
                                echo '<option value="' . $idResult . '">' . $sResult 
                                        . 'S ' . $mahResult . 'mah ' . $cResult . 'C' . '</option>';
                            }
                            echo '</select><br>';
                            ?>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

