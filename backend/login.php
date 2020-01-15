<?php
require_once './functions.php';
require_once './header.php';
$error = $user = $pass = "";
if (isset($_POST['user'])) {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    if ($user == "" || $pass == "") {
        $error = "Not all fields was entered";
    } else {
        $token = passwordToToken($pass);
        $result = queryMysql("SELECT * FROM user WHERE username = '$user' AND password = '$pass'");
        if ($result->num_rows == 0) {
            $error = "Username/Password invalid";
        } else {
            session_start();
            $_SESSION['uId'] = mysqli_fetch_array($result)[0];
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            header("Location: index.php"); //redirect to index.php
            die("You already log in. Please <a href='index.php'>click here</> to continue.");
        }
    }
}
?>
<br>
<form method="post" action="login.php">
    <fieldset class="fitContent">
        <legend>Please login</legend>
        <span class="error"><?php echo $error ?></span><br>
        Username: <br>
        <input type="text" name="user" value="<?php echo $user; ?>"/><br>
        Password : <br>
        <input type="password" name="pass" value="<?php echo $pass; ?>"/><br>
        <input type="submit" value="Login"/>
    </fieldset>
</form>
</body>
</html>


