<?php
require_once './header.php';
require_once './restrictedsession.php';
$query = "SELECT ID,username,status FROM user";
if(isset($_POST['keyword'])){
    $keyword = sanitizeString($_POST['keyword']);
    $query = $query . " WHERE username LIKE '%$keyword%' OR ID LIKE'%$keyword%'";
}
$result = queryMysql($query);
$error = $msg = "";
if (!$result){
    $error = "Couldn't load data, please try again.";
}
?>
<br><br>
<div>
    <form action="loadadmin.php" method="post">
        Search username:
        <input type="search" name="keyword"/>
        <input type="submit" value="Go"/>
    </form>
</div>
<br>
<table class="tbl">
    <tr>
        <th>ID</th>
        <th>Username</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        $ID=$row[0];
        $username = $row[1];
        $status = $row[2];
        echo "<tr>";
        echo "<td>$ID</td>";
        echo "<td>$username</td>";
        ?>
        <td>
            <form class="frminline" action="deleteadmin.php" method="post" onsubmit="return confirmDelete();">
                <input type="hidden" name="ID" value="<?php echo $row[0] ?>" />
                <input type="submit" value="Delete" />
            </form>
            <form class="frminline" action="updateadmin.php" method="post">
                <input type="hidden" name="ID" value="<?php echo $row[0] ?>" />
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

