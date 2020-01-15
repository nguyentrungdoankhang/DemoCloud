 <?php
require_once 'header.php';
//Check to make sure that user is logged in first
require_once 'restrictedsession.php';
$error = $msg = "";
if (isset($_POST['ID'])) { //updating
    $ID=sanitizeString($_POST['ID']);
    $username = sanitizeString($_POST['username']);
    $uId = $_SESSION['uId'];
     $query = "UPDATE user SET username = '$username' WHERE ID='$ID'";
        $result = queryMysql($query);
        if (!$result) {
            $error = "Couldn't update admin $username, please try again";
        } else {
            $msg = "Updated $username successfully";
        }
    }
//for loading the data to the form
if (isset($_POST['ID'])) {
    $ID = sanitizeString($_POST['ID']);
    //Load the current data 
    $query = "SELECT username, status FROM user WHERE ID = '$ID'";
    $result = queryMysql($query);
    $row = mysqli_fetch_array($result);
    if ($row) {
        $username = $row[0];
        $status = $row[1];
    }
}
?>
<br><br>
<form action="updateadmin.php" method="POST">
    <fieldset>
        <legend>Update admin</legend>
        <div class="error"><?php echo $error; ?></div>
        <input type="hidden" value="<?php echo $ID; ?>" name="ID"/>
        Username: </br>
        <input type="text" id="username" name="username" required value="<?php echo $username; ?>"/><br>
        Status: <br>
        <textarea name="c"><?php echo $status; ?></textarea><br><br>
        <input type="submit" value="Update"/>
        <div><?php echo $msg; ?></div>
    </fieldset>
</form>
</body>
</html>
