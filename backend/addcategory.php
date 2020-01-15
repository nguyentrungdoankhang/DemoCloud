<?php
require_once './header.php';
    $error = $message = "";
if (isset($_POST['cID'])) 
{
    $cID = sanitizeString($_POST['cID']);
    $cName = sanitizeString($_POST['cName']);
    $cDescription = sanitizeString($_POST['cDescription']);
        $uId = $_SESSION['uId'];
        $query = "INSERT INTO Category(ID,Name,Description)"
                . "values('$cID','$cName','$cDescription')";
        $result = queryMysql($query);
        if (!$result) {
            $error = "Adding error, please try again";
        } else {
            $message = "Added successfully";
        }
}
?>
<br>
<form action = "addcategory.php" method = "post">
    <fieldset class = "fitContent">
        <legend>Add Brand</legend>
        <span class="error"><?php echo $error; ?></span><br>
        ID<br>
        <input type="text" name="cID" id="categoryID" required><br>
        Name<br>
        <input type="text" name="cName" id="categoryName" placeholder="(e.g., Lamborghini)" required /><br>
        Description
        <br>
        <textarea name="cDescription" placeholder="(e.g., Super car)"></textarea>
        <br><br>
        <input type="submit" value="Add" /><br>
        <span><?php echo $message; ?></span><br>
    </fieldset>
</form>
</body>
</html>

