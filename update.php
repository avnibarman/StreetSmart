<?php

if(empty($_REQUEST['id'])) {
    echo "You reached this page in error.";
    exit();
}

$conn = mysqli_connect("uscitp.com", "abarman", "6163957274", "abarman_walkability");

if(mysqli_connect_errno()) {
    echo "Failed to connect to mySql: " . mysqli_connect_errno();
    exit();
}

$incomescore = $_REQUEST['income'];
$crimescore = $_REQUEST['crime'];
$walkabilityscore = $incomescore + $crimescore;


$sql = "UPDATE neighborhoods SET neighborhood_name = ".$_REQUEST['neighborhood_name'].",".
    " crime_id = ".$_REQUEST['crime'].", ".
    " income_id = ".$_REQUEST['income'].", ".
    " walkability_score = ".$walkabilityscore.
    " WHERE id = ".$_REQUEST['id'];

$results = mysqli_query($conn, $sql);

if(!$results) {
    //echo $sql;
    echo mysqli_error($conn);
    exit();
}

echo "The neighborhood has been updated!";
echo "</br>" . "Return to the " . "<a href='search.php'>Home Page</a>";

?>



