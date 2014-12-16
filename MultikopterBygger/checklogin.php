<?php
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == FALSE) {
    header('Location: login.php');
}elseif (isset($_SESSION['timeout']) && ($_SESSION['timeout'] + 30 * 60 < time())) {
    $_SESSION['loggedin'] = FALSE;
    header('Location: login.php?r=timeout');
}
 else {
    $_SESSION['timeout'] = time();
}

if(isset($_POST['logout'])) {
    session_unset('loggedin');
    header('Location: login.php');
}