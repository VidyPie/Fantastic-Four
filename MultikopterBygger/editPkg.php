<?php
include './dbConnect.php';
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
            <div id="Content">
                <?php
                //Dropdown for å velge hvilken type del som skal redigeres, deretter et vindu med scroppbar der den spesifikke delen velges.
                //For å redigere pakker, blir det kun det vinduet, med radial buttons elns. kjører form og submitknapp. Good times.
                ?>
            </div>
        </div>
    </body>
</html>
