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
$salt1 = "qm&h*";
$salt2 = "!@#$%";
//this is used to execute all SQL queries
function queryMysql($query) {
    global $connection;
    $result = $connection->query($query);
    if (!$result) {
        die ($connection->error);
    }
    return $result;
}

//this is used to create table
function createTable($name, $body){
    $str = "CREATE TABLE IF NOT EXISTS $name($body)";
    queryMysql($str);
    echo "Table $name is created or already exists";
}

//this is for security purpose
function sanitizeString($str) {
    global $connection;
    $str = strip_tags($str); //remove html tags
    $str = htmlentities($str); //encode html (for special characters)
    if (get_magic_quotes_gpc()){
        $str = stripslashes($str); //Don't use the magic quotes
    }
    //Avoid MYSQL Injection
    $str = $connection->real_escape_string($str);
    return $str;
}

//Convert password into encrypted form
function passwordToToken($password){
    global $salt1;
    global $salt2;
    $token = hash ("ripemd128", "$salt1$password$salt2");
    return $token;
}

//Add user to the database
function addUser($username, $password, $status){
    //Setup one default user
    $result = queryMysql("SELECT * FROM User where username='$username'");
    $row = mysqli_fetch_assoc($result);
    if (!$row) { //user doesn't exist
        //Add a default user
        $token = passwordToToken($password);
        $query = "INSERT INTO User(username, password, status) VALUES('$username', '$token', '$status')";
        queryMysql($query);
        return 1; //added
    }else {
        return 0; //not added
    }
}