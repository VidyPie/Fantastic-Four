<?PHP
include 'checklogin.php';
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
            <a href="index.html"><img class="banner" src="main_styling/banner.png" alt ="Kopterbygger"></a>
            <img class="extension" src="main_styling/bannerext.png" alt="graybox">
        </div>
        <div id="wrapper">
            <div id="content">
                <h2>Administrasjon</h2>
                <a class="abutton" href="addParts.php?f=">Legg til deler</a><br><br>
                <a class="abutton" href="pktConfig.php">Sette sammen pakker</a>
            </div>
        </div>
    </body>
</html>