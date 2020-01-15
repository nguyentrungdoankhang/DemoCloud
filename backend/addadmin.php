<?php
require_once './header.php';
    $error = $message = "";
if (isset($_POST['ID']))
 {
    $ID=sanitizeString($_POST['ID']);
    $Account = sanitizeString($_POST['Account']);
    $Password = sanitizeString($_POST['Password']);
        $uId = $_SESSION['uId'];
        $token=passwordToToken($Password);
        $query = "INSERT INTO user(ID,username,password)"
                . "values('$ID','$Account','$token')";
        $result = queryMysql($query);
        if (!$result) {
            $error = "Adding error, please try again";
        } else {
            $message = "Added successfully";
        }
    }
?>
<br>
<form action = "addadmin.php" method = "post">
    <fieldset class = "fitContent">
        <legend>Add Admin</legend>
        <span class="error"><?php echo $error; ?></span><br>
        ID:<br>
        <input type="text" name="ID" id="ID" required><br>
        Account:<br>
        <input type="text" name="Account" id="Account" required /><br>
        Password:
        <br>
        <input type="password" name="Password" id="Password" required /><br>
        <br><br>
        <input type="submit" value="Add" /><br>
        <span><?php echo $message; ?></span><br>
    </fieldset>
</form>
</body>
</html>

