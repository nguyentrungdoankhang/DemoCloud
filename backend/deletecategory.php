<?php
session_start();
require_once './functions.php';
require_once './restrictedsession.php';
if (isset($_POST['cId'])) {
    $cId = sanitizeString($_POST['cId']);
    $query = "DELETE FROM Category WHERE ID = '$cId'";
    queryMysql($query);
    header("Location: loadcategory.php");
    die("You've deleted the category '$cId' <a href='loadcategory.php'>click here</a> to continue.");
}
?>

