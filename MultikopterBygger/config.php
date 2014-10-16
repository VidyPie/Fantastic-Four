
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
                    echo '<div id="dropdown"><p>Komponenter</p>';
                    $motorID = $_SESSION['motorSelected'];
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
                ?>
                </form>
            </div>
        </div>
    </body>
</html>
