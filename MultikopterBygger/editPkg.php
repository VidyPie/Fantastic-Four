<?php
include './dbConnect.php';
include './editPkgFuncParts.php';
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
            <a href=index.html>
                <img class="banner" src="main_styling/banner.png" alt ="Kopterbygger">
            </a>
            <a href=index.html>
                <img class="extension" src="main_styling/bannerext.png" alt="graybox">
            </a>
        </div>
        <div id="wrapper">
            <div id="Content">
                <form>
                    <select name="part" onchange="document.location.href = this.value">
                        <option value="">---Velg delkategori---</option>
                        <option value="editPkg.php?f=editMotor">Motor</option>
                        <option value="editPkg.php?f=editESC">ESC</option>
                        <option value="editPkg.php?f=editBoard">Kontrollbrett</option>
                        <option value="editPkg.php?f=editProp">Propell</option>
                        <option value="editPkg.php?f=editBat">Batteri</option>
                    </select>
                </form>
                <br>
                <?php
                //Dropdown for å velge hvilken type del som skal redigeres, deretter et vindu med scroppbar der den spesifikke delen velges.
                //For å redigere pakker, blir det kun det vinduet, med radial buttons elns. kjører form og submitknapp. Good times.
                if (isset($_POST['part'])) {
                    $part = $_POST['part'];
                } else {
                    $part = '';
                }

                if (isset($_GET['f'])) {
                    $_GET['f']();
                }
                ?>
            </div>
        </div>
    </body>
</html>
