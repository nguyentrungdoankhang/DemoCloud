<?php
session_start();
require_once './functions.php';
require_once './restrictedsession.php';
if (isset($_POST['carId'])) {
    $carId = sanitizeString($_POST['carId']);
    $query = "DELETE FROM Car WHERE ID = '$carId'";
    queryMysql($query);
    header("Location: loadcar.php");
    die("You've deleted the car '$carId' <a href='loadcar.php'>click here</a> to continue.");
}
?>

