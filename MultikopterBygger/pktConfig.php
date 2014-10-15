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

        <div id="banner">
            <img src="main_styling/banner.png" alt ="Kopterbygger">


            <div id='wrapper'>
                <div id='content'>
                    <form name="components" method="POST">
                        <?php
                        $con = $_SESSION['connection'];
                        echo 'Velg komponenter for pakke:<br>';
                        echo '<select name="motordropdown">';
                        $query = "SELECT * FROM motor";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $nameResult = $row['Navn'];
                            $idResult = $row['MotorID'];
                            echo '<option value="' . $idResult . '">' . $nameResult . '</option>';
                        }
                        echo '</select><br>';

                        echo '<select name="escdropdown">';
                        $query = "SELECT * FROM esc";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $nameResult = $row['Navn'];
                            $idResult = $row['ESCID'];
                            echo '<option value="' . $idResult . '">' . $nameResult . '</option>';
                        }
                        echo '</select><br>';

                        echo '<select name="propdropdown">';
                        $query = "SELECT * FROM propeller";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $nameResult = $row['Navn'];
                            $idResult = $row['PropellID'];
                            $diaResult = $row['Prop_dia'];
                            $vinResult = $row['Prop_vin'];
                            echo '<option value="' . $idResult . '">' . $nameResult
                            . ' ' . $diaResult . '"x' . $vinResult . '</option>';
                        }
                        echo '</select><br>';

                        echo '<select name="kontrollbrettdropdown">';
                        $query = "SELECT * FROM kontrollbrett";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $nameResult = $row['Navn'];
                            $idResult = $row['KontrollbrettID'];
                            echo '<option value="' . $idResult . '">' . $nameResult . '</option>';
                        }
                        echo '</select><br>';

                        echo '<select name="batteridropdown">';
                        $query = "SELECT * FROM batteri";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $mahResult = $row['mah'];
                            $cResult = $row['C_max'];
                            $sResult = $row['Celler'];
                            $idResult = $row['BatteriID'];
                            echo '<option value="' . $idResult . '">' . $sResult
                            . 'S ' . $mahResult . 'mah ' . $cResult . 'C' . '</option>';
                        }
                        echo '</select><br>';
                        ?>
                        <input type="submit" value="Legg inn">
                    </form>
                    <table border='1'>
                        <tr>
                            <th></th>
                            <th>Videoopptak</th>
                            <th>Flytid</th>
                            <th>GPS</th>
                        </tr>
<?php
$query = "SELECT * FROM spesifikasjoner";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result)) {
    echo '<tr>';
    echo '<td><form><input type="checkbox" name="spec" value="' . $row['SpesifikasjonID'] . '"></form></td>';
    echo '<td>' . $row['Rekkevidde'] . '</td>';
    echo '<td>' . $row['Videoopptak'] . '</td>';
    echo '<td>' . $row['GPS'] . '</td>';
    echo '</tr>';
}
?>
                    </table>
                    <p>asf</p>

<?php
$con = $_SESSION['connection'];

if (isset($_POST['motordropdown'])) {
    $row = mysqli_fetch_array(mysqli_query($con, "SELECT MAX(KomponenterID) AS lastID FROM komponenter"));
    $id = $row['lastID'] + 1;

    $motor = $_POST['motordropdown'];
    $esc = $_POST['escdropdown'];
    $prop = $_POST['propdropdown'];
    $kontrollbrett = $_POST['kontrollbrettdropdown'];
    $batteri = $_POST['batteridropdown'];

    $query = "INSERT INTO `komponenter` (`KomponenterID`, `BatteriID`, "
            . "`KontrollbrettID`, `PropellID`, `MotorID`, `ESCID`) ";
    $query .= "VALUES (" . $id . ", " . $batteri . ", " . $kontrollbrett
            . ", " . $prop . ", " . $motor . ", " . $esc . ");";

    mysqli_query($con, $query);
    mysqli_close($con);
    echo 'Success!';
}
?>
                </div>
            </div>
        </div>
    </body>
</html>

