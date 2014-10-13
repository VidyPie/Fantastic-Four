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
            <img class="frame" src="main_styling/frame.png" alt="frame">
        </div>

        <div class="frame">
            <div class="inframe_text">
                <?php
                $videoopptak = $_POST["videoopptak"];
                $airtime = $_POST["airtime"];
                $gps = $_POST["gps"];
                echo "For videoopptak har du valgt: " . $videoopptak . "<br>";
                echo "For tid og rekkevidde har du valgt: " . $airtime . "<br>";
                echo "For gps på kontrollbrett har du valgt: " . $gps;
                ?>
            </div>
            

        </div>





    </body>
</html>
