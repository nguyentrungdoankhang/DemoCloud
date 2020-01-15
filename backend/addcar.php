<?php
require_once 'header.php';
require_once 'restrictedsession.php';
//getting the data
$error = $msg = "";
if (isset($_POST['add'])) { //adding
    $carId = sanitizeString($_POST['carId']);
    $carName = sanitizeString($_POST['carName']);
    $carType = sanitizeString($_POST['carType']);
    $carDescription = sanitizeString($_POST['carDescription']);
    $carPrice = sanitizeString($_POST['carPrice']);
    $carImage = "";
    $carCategory=  sanitizeString($_POST['carCategory']);
    $extension = "";
    //Process the uploaded image
    if (isset($_FILES['carImage']) && $_FILES['carImage']['size'] != 0) {
        $temp_name = $_FILES['carImage']['tmp_name'];
        $name = $_FILES['carImage']['name'];
        $parts = explode(".", $name);
        $lastIndex = count($parts) - 1;
        $extension = $parts[$lastIndex];
        $carImage = "$carId.$extension";
        $destination = "images/car/$carImage";
        //Move the file from temp loc => to our image folder
        move_uploaded_file($temp_name, $destination);
    }
    $carCategory = sanitizeString($_POST['carCategory']);
    //Add the car
    $query = "INSERT INTO Car values ('$carId','$carName','$carType','$carDescription','$carPrice','$carImage','$carCategory')";
    $result = queryMySql($query);
    if (!$result) {
        $error = $error . "<br>Can't add car, please try again";
    } else {
        $msg = "Added $carName successfully!";
    }
}
?>
<br><br>
<form action="addcar.php" method="POST" enctype="multipart/form-data">
    <fieldset class = "fitContent">
        <div class="error"><?php echo $error; ?></div>
        <div class="msg"><?php echo $msg; ?></div>
        <legend>Add Car</legend>
        ID: <br>
        <input type="text" name="carId" size="15" maxlength="8" placeholder="(e.g.,00001)"
               required/><br>
        Name: <br>
        <input type="text" name="carName" maxlength="50" required/><br>
        Type:<br>
        <select name="carType">
            <option value="SuperCar">Super Car</option>
            <option value="LuxuryCar">Luxury Car</option>
            <option value="HybridCar">Hybrid Car</option>
        </select>
        <br>
         Description:<br>
        <textarea maxlength="10000" name="carDescription" placeholder="color ,status "></textarea><br>
        Price:<br>
        <input type="text" name="carPrice" maxlength="100"><br>
        Image:<br>
        <input type="file" name="carImage"/><br>
        Category:<br>
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
        <input type="submit" value="Add" name="add"/>
    </fieldset>
</form>
</body>
</html>

