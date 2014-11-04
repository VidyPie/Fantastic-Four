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
        <div id="wrapper">
            <div id="leftContent">
                <?php
                if (isset($_GET['r'])) {
                    if ($_GET['r'] == 'timeout') {
                        echo 'Session timed out, please log in again:';
                    }
                }
                ?>
                <form name="Login" method="POST">
                    <input type="text" name="usr" placeholder="username" autofocus><br>
                    <input type="password" name="passwd" placeholder="Passord"><br>
                    <input type="submit" name="Login">
                </form>
                <?php
                //lolSkittenKode - xXxYOLOSWAGNOSCOPE#420#xXx /s
                if (isset($_POST['Login'])) {
                    $con = $_SESSION['connection'];

                    $usrName = $_POST['usr'];
                    $passwd = $_POST['passwd'];

                    if ($usrName == NULL) {
                        echo 'Feil brukernavn eller passord';
                        exit();
                    }
                    $Query = "SELECT `username`,`password` FROM `users` WHERE username ='" . $usrName . "'";
                    $result = mysqli_query($con, $Query);

                    $row = mysqli_fetch_array($result);
                    $dbUsername = $row['username'];
                    $dbPasswd = $row['password'];

                    if (empty($row)) {
                        echo 'Feil brukernavn eller passord';
                        exit();
                    } else {
                        if ($passwd == $dbPasswd) {
                            $_SESSION['loggedin'] = TRUE;
                            $_SESSION['timeout'] = time();
                            header('Location: administrasjon.php');
                        } elseif ($passwd != $dbPasswd) {
                            echo 'Feil brukernavn eller passord';
                        }
                    }
                }
                //if usrname not in db exit()
                else {
                    echo '<br>Det kreves brukernavn og passord for å kunne administrere basen.';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

