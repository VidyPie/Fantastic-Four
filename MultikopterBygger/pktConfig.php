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
                    <div align="center">
                        <select name="mydropdown">
                            <?php
                            $con = $_SESSION['connection'];

                            $query = "SELECT * FROM motor";

                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                $nameResult = $row['Navn'];
                                $idResult = $row['MotorID'];
                                echo '<option value="' . $idResult . '">' . $nameResult . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

