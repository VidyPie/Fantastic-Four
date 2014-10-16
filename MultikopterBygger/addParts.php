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
                
                <?php
                if(isset($_POST['part'])) {
                    $part = $_POST['part'];
                }
                else{
                    $part = '';
                }
                
                echo'
                <form>
                    <select name="part" onchange="document.location.href=this.value">
                        <option value="">----Velg type del----</option>
                        <option value="addParts.php?f=addmotor">Motor</option>
                        <option value="addParts.php?f=addesc">ESC</option>
                        <option value="addParts.php?f=addboard">Kontrollbrett</option>
                        <option value="addParts.php?f=addprop">Propell</option>
                        <option value="addParts.php?f=addbat">Batteri</option>
                    </select>
                </form><br>';
                
                if (function_exists($_GET['f'])) {
                    $_GET['f']();
                }

                function addmotor() {
                    echo '
                    Angi verdier som skal legges inn for motoren<br>
                    <form name="motorAddForm" method="POST">
                        <input min="0" type="number" name="kVInput" placeholder="kV"><br>
                        <input min="0" type="number" name="ampInput" placeholder="Amps"><br>
                        <input min="0" type="number" name="prisInput" placeholder="Pris"><br>
                        <input min="0" type="number" name="prop_diaInput" placeholder="Propell diameter"><br>
                        <input min="0" type="number" name="prop_vinInput" placeholder="Propell vinkel"><br>
                        <input min="0" type="number" name="CE_maxInput" placeholder="Lipocell max"><br>
                        <input min="0" type="number" name="CE_minInput" placeholder="Lipocell min"><br>
                        <input type="text" name="navnInput" placeholder="Navn" size="50"><br>
                        <input type="submit" name="submit">
                    </form>';
                }
                ?>
            </div>
        </div>
    </body>
</html>