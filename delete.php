

<?php
$conn = mysqli_connect("uscitp.com", "abarman", "6163957274", "abarman_walkability");

if(mysqli_connect_errno()){
    echo "the error is ".mysqli_connect_errno()."";
    exit();
}

if(empty($_REQUEST['id'])){
    echo "Please go through the admin.";
    exit();
}

if($_REQUEST['confirm'] == "YES"){
    echo "DELETING RECORD...";

    $sql = "DELETE FROM neighborhoods WHERE id = ".$_REQUEST['id'];

    $results = mysqli_query($conn, $sql);

    if(!$results) {
        echo "Your SQL: " . $sql . "<br><br>";
        echo "SQL Error: " . mysqli_error($conn);
        exit();
    }

    exit();
}
?>

Are you sure you want to delete this record?

<form action="delete.php">

    <input type=hidden" name="id" value ="<?php echo $_REQUEST['id']; ?>">
    <input type="submit" value="YES" name="confirm">

</form>