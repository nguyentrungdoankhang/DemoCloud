<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
$dburl="postgres://fzqvsewfpuqchj:96e10f952004d3329102ea5a6ca8c573457a277edbfd202dac960770eee01306@ec2-23-21-248-1.compute-1.amazonaws.com:5432/dajgb2vte7s24a
";
$dbhost = "ec2-23-21-248-1.compute-1.amazonaws.com";
$dbport = 5432;
$dbuser = "fzqvsewfpuqchj";
$dbpassword = "96e10f952004d3329102ea5a6ca8c573457a277edbfd202dac960770eee01306";
$dbname = "dajgb2vte7s24a";
$salt1 = "qm&h*";
$salt2 = "!@#$%";
//Connect to the DB
$connection = new mysqli($dburl,$dbhost, $dbuser, $dbpassword, $dbname, $dbport);
if ($connection->connect_error) {
    die ($connection->connect_error);
}
?>
</body>
</html>