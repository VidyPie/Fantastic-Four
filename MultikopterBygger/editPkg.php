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
                <div id="theChoochooshoe">
                    <?php
                    //shit comes here
                    $con = $_SESSION['connection'];
                    
                    $Query = 'Select * FROM Oppskrift';
                    $result = mysqli_query($con, $Query);
                    while ($row = mysqli_fetch_array($result)) {
                        $OppID = $row['OppskriftID'];
                        $SpesID = $row['SpesifikasjonID'];
                        $KompID = $row['KomponenterID'];
                        $beskr = $row['Beskrivelse'];
                        echo $OppID . ' ' . $SpesID . ' ' . $KompID . ' ' . $beskr . '<br>';
                        //legg inn knapp for å delete her, må sikkert legge dritten inn i en form.
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
