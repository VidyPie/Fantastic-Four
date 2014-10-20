<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == FALSE) {
    header('Location: login.php');
}elseif (isset($_SESSION['timeout']) && ($_SESSION['timeout'] + 10 * 60 < time())) {
    $_SESSION['loggedin'] = FALSE;
    header('Location: login.php?r=timeout');
}
