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
                    <input type="text" name="usr" placeholder="username"><br>
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
                        echo '<h1>STOP RIGHT THERE CRIMINAL SCUM!</h1><br>';
                        echo '<img src="main_styling/wowSuchPassword.jpg" alt="LOLNICETRY!">';
                        echo '<br>Hint: Det kan hjelpe om du skriver inn brukernavn..........';
                        exit();
                    }
                    $Query = "SELECT `username`,`password` FROM `users` WHERE username ='" . $usrName . "'";
                    $result = mysqli_query($con, $Query);

                    $row = mysqli_fetch_array($result);
                    $dbUsername = $row['username'];
                    $dbPasswd = $row['password'];

                    if (empty($row)) {
                        echo '<h1>STOP RIGHT THERE CRIMINAL SCUM! YOU ARE NOT A USER!</h1><br>';
                        echo '<img src="main_styling/wowSuchPassword.jpg" alt="LOLNICETRY!">';
                        exit();
                    } else {
                        if ($passwd == $dbPasswd) {
                            $_SESSION['loggedin'] = TRUE;
                            $_SESSION['timeout'] = time();
                            header('Location: administrasjon.php');
                        } elseif ($passwd != $dbPasswd) {
                            echo '<h1>STOP RIGHT THERE CRIMINAL SCUM!</h1><br>';
                            echo '<img src="main_styling/wowSuchPassword.jpg" alt="LOLNICETRY!">';
                        }
                    }
                }
                //if usrname not in db exit()
                else {
                    echo '<br>Login! I dare you! I double dare you motherfucker!!'
                    . '<br><img src="main_styling/REALSHIT.jpg" alt="BELIEVE IT!">';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

