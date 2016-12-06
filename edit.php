<?php

if(empty($_REQUEST['id'])) {
    echo "You reached this page in error.";
    exit();
}

$conn = mysqli_connect('uscitp.com', 'abarman', '6163957274', 'abarman_walkability');

if(mysqli_connect_errno()) {
    echo "Failed to connect to mySql: " . mysqli_connect_errno();
    exit();
}

$sql = " SELECT * FROM sample_data WHERE id = ".$_REQUEST['id'];

$results = mysqli_query($conn, $sql);
$info = mysqli_fetch_array($results);

$neighborhoodsql = 'SELECT * FROM neighborhoods';
$neighborhoodresults = mysqli_query($conn, $neighborhoodsql);

$crimesql = 'SELECT * FROM crime';
$crimeresults = mysqli_query($conn, $crimesql);

$incomesql = 'SELECT * FROM income';
$incomeresults = mysqli_query($conn, $incomesql);

echo "Editing neighborhood : ".$info['neighborhood_name'];
?>

<form action="update.php">

    <select name="neighborhood_name">

        <?php

        echo "<option selected='1' value ='".
            $info['id']."'>".
            $info['neighborhood_name']."</option>";

        while($currentrow = mysqli_fetch_array($neighborhoodresults)) {
            echo "<option value ='".$currentrow['id']."'>" . $currentrow['neighborhood_name'] . "</option>";
        }
        ?>
    </select>


    <select name="crime">

        <?php

        echo "<option selected='1' value ='".
            $info['id']."'>".
            $info['crime_score']."</option>";

        while($currentrow = mysqli_fetch_array($crimeresults)) {
            echo "<option value ='".$currentrow['id']."'>" . $currentrow['crime_score'] . "</option>";
        }
        ?>
    </select>

    <select name="income">

        <?php

        echo "<option selected='1' value ='".
            $info['id']."'>".
            $info['income_score']."</option>";

        while($currentrow = mysqli_fetch_array($incomeresults)) {
            echo "<option value ='".$currentrow['id']."'>" . $currentrow['income_score'] . "</option>";
        }
        ?>
    </select>

    <input type="hidden" name ="id" value="<?php echo $info['id']; ?>">
    <input type = "submit">

</form>
