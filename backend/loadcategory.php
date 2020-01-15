<?php
require_once './header.php';
require_once './restrictedsession.php';
$query = "SELECT ID,Name, Description from Category";
if(isset($_POST['keyword'])){
    $keyword = sanitizeString($_POST['keyword']);
    $query = $query . " WHERE Name LIKE '%$keyword%' OR Description LIKE '%$keyword%' OR ID LIKE'%&keyword%'";
}
$result = queryMysql($query);
$error = $msg = "";
if (!$result){
    $error = "Couldn't load data, please try again.";
}
?>
<br><br>
<div>
    <form action="loadcategory.php" method="post">
        Search Brand:
        <input type="search" name="keyword"/>
        <input type="submit" value="Go"/>
    </form>
</div>
<br>
<table class="tbl">
    <tr>
        <th>Brand ID</th>
        <th>Brand Name</th>
        <th>Brand Description</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        $cId=$row[0];
        $cName = $row[1];
        $cDescription = $row[2];
        echo "<tr>";
        echo "<td>$cId</td>";
        echo "<td>$cName</td>";
        echo "<td>$cDescription</td>";
        ?>
        <td>
            <form class="frminline" action="deletecategory.php" method="post" onsubmit="return confirmDelete();">
                <input type="hidden" name="cId" value="<?php echo $row[0] ?>" />
                <input type="submit" value="Delete" />
            </form>
            <form class="frminline" action="updatecategory.php" method="post">
                <input type="hidden" name="cId" value="<?php echo $row[0] ?>" />
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

