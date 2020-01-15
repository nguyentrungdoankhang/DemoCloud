<?php
require_once './header.php';
//Check to make sure that user is logged in first
require_once './restrictedsession.php';
$error = $msg = "";
if (isset($_POST['carName'])) { //updating
    $carId = sanitizeString($_POST['carId']);
    $carName = sanitizeString($_POST['carName']);
    $carType = sanitizeString($_POST['carType']);
    $carDescription = sanitizeString($_POST['carDescription']);
    $carPrice = sanitizeString($_POST['carPrice']);
    $carCategory = sanitizeString($_POST['carCategory']);
    $uId = $_SESSION['uId'];
    $query = "UPDATE Car SET Name = '$carName', Type = '$carType', Description = '$carDescription', Price = '$carPrice',Category = '$carCategory' WHERE ID = '$carId'";
    $result = queryMysql($query);
    if (!$result) {
        $error = "Couldn't update car $carName, please try again";
    } else {
        $msg = "Updated $carName successfully";
    }
}
//for loading the data to the form
if (isset($_POST['carId'])) {
    $carId = sanitizeString($_POST['carId']);
    //Load the current data to that category
    $query = "SELECT Name, Type,Description, Price,Category FROM car WHERE ID = '$carId'";
    $result = queryMysql($query);
    $row = mysqli_fetch_array($result);
    if ($row) {
        $carName = $row[0];
        $carType = $row[1];
        $carDescription= $row[2];
        $carPrice = $row[3];
        $carCategory=$row[4];
    }
}
?>
<br><br>
<form action="updatecar.php" method="POST">
    <fieldset>
        <legend>Update car</legend>
        <div class="error"><?php echo $error; ?></div>
        <input type="hidden" value="<?php echo $carId; ?>" name="carId"/>
        Name: </br>
        <input type="text" id="carName" name="carName" required value="<?php echo $carName; ?>"/><br>
        Type:<br>
        <select id="carType" name="carType">
            <option value="SuperCar">Super Car</option>
            <option value="LuxuryCar">Luxury Car</option>
            <option value="HybridCar">Hybrid Car</option>
        </select><br>
        Description: </br>
        <input type="text" id="carDescription" name="carDescription" required value="<?php echo $carDescription; ?>"/><br>
        Price </br>
        <input type="text" id="carPrice" name="carPrice" required value="<?php echo $carPrice; ?>"/><br>
        Category </br>
       <select name="carCategory">
            <?php
            $query = "SELECT ID, Name FROM Category";
            $categorys = queryMysql($query);
            while ($category = mysqli_fetch_array($categorys)) {
                $cId = $category[0];
                $cName = $category[1];
                echo "<option value='$cId'>$cName</option>";
            }
            ?>
        </select><br><br>
        <input type="submit" value="Update"/>
        <div><?php echo $msg; ?></div>
    </fieldset>
</form>
</body>
</html>
