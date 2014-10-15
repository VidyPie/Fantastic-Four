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
          
        <div class="frame2">
        
            <div class="left_box"><b>Forslag 1</b>
                <br>
           <?php
                $con = $_SESSION['connection'];
            
            
            $query = "SELECT * FROM oppskrift";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result)) {
                $beskrivelseResult = $row['Beskrivelse'];
                echo $beskrivelseResult;
            }
                ?>
                 <br><br>motor<br>
             
                propell<br>
                kontrollbrett<br>
                esc<br>
                batteri<br>
            <br><br><br>
               
        
            <a href="http://vg.no"><img class="left_velg" src="main_styling/velg.png"></a>
            <a href="http://db.no"><img class="left_config" src="main_styling/config.png"></a>
            </div>
            
            
            
            <div class="right_box"><b>Forslag 2</b><br><br>motor<br>propell<br>kontrollbrett<br>esc<br>batteri<br>
            <br><br><br>
            <a href="http://smp.no"><img class="right_velg" src="main_styling/velg.png"></a>
            <a href="http://reddit.com"><img class="right_config" src="main_styling/config.png"></a>
        </div>
    </body>
</html>                 
