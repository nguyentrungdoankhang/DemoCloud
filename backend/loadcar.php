<?php
require_once './header.php';
require_once './restrictedsession.php';
$query = "SELECT ID, Name, Type,Description, Price,Image,Category FROM Car";
if(isset($_POST['keyword'])){
    $keyword = sanitizeString($_POST['keyword']);
    $query = $query . " WHERE Name LIKE '%$keyword%' OR ID LIKE '%$keyword%'";
}
$result = queryMysql($query);
$error = $msg = "";
if (!$result){
    $error = "Couldn't load data, please try again.";
}
?>
<br><br>
<div>
    <form action="loadcar.php" method="post">
        Search car:
        <input type="search" name="keyword"/>
        <input type="submit" value="Go"/>
    </form>
</div>
<br>
<table class="tbl">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Description</th>
        <th>Price</th>
        <th>Image</th>   
        <th>Branch</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        $carID = $row[0];
        $carName = $row[1];
        $carType = $row[2];
        $carDescription = $row[3];
        $carPrice = $row[4];
        $carImage = $row[5];
        $carCategory = $row[6];
        echo "<tr>";
        echo "<td>$carID</td>";
        echo "<td>$carName</td>";
        echo "<td>$carType</td>";
        echo "<td>$carDescription</td>";
        echo "<td>$carPrice</td>";
        echo "<td ><img src='images/car/". $carImage . "' height='50px'></td>";
        echo "<td>$carCategory</td>";
        ?>
        <td>
            <form class="frminline" action="deletecar.php" method="post" onsubmit="return confirmDelete();">
                <input type="hidden" name="carId" value="<?php echo $row[0] ?>" />
                <input type="submit" value="Delete" />
            </form>
            <form class="frminline" action="updatecar.php" method="post">
                <input type="hidden" name="carId" value="<?php echo $row[0] ?>" />
                <input type="submit" value="Update" />
            </form>
        </td>
        <?php
        echo "</tr>";
    }
    ?>
    <script>
        function confirmDelete() {
            var r = confirm("Are you sure you would like to delete ?");
            if (r) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</table>
</body>
</html>

