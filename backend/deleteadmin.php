<?php
session_start();
require_once './functions.php';
require_once './restrictedsession.php';
if (isset($_POST['ID'])) {
    $ID = sanitizeString($_POST['ID']);
    $query = "DELETE FROM user WHERE ID = '$ID'";
    queryMysql($query);
    header("Location: loadadmin.php");
    die("You've deleted admin '$username' <a href='loadadmin.php'>click here</a> to continue.");
}
?>

