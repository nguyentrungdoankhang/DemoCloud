<?php
$loggedin = FALSE;
if (isset($_SESSION['user'])){
    $loggedin = TRUE;
}
if (!$loggedin) {
    die("<br><span class='fitContent'>Restricted, please login</span>");
}
?>
