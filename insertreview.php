<?php

session_start();

$conn = mysqli_connect('uscitp.com', 'abarman', '6163957274', 'abarman_walkability');

$user = $_SESSION['user'];
//var_dump($user);

if(mysqli_connect_errno()){
    echo mysqli_connect_errno();
    exit();
}

?>

<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" ></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link href="http://allfont.net/allfont.css?fonts=caviar-dreams" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">

    <title>Street Smart</title>



</head>

<style>
    body{
        font-family: Raleway;
    }
</style>

<body>
<ul id="menu">
    <li><a href="search.php"><img class="mapicon" src="logo.png"></a></li>
    <li ><a href="search.php"><span class="logo"><b>STREET SMART</b></span>&nbsp;&nbsp;</a></li>
    <li><a href="theTeam.php">About</a></li>
    <li><a href="contactUs.php">Contact</a></li>
    <?php
    if(!empty($user)) {
        echo "<li><form action='logout.php'><input name='logout' type='submit' value='logout'></form></li>";
    }
    ?>

</ul>

<?php
$id = $_REQUEST['id'];
echo $id;
if(empty($_REQUEST['review'])) {
    //echo "Please go the <a href='details.php'>review</a> page.";
    echo "<script>window.location.href = 'review.php?id=".$id."';</script>";
    exit();
}

if(empty(trim($_REQUEST['review']))) {
    echo "You must enter a review.";
    exit();
}

$conn = mysqli_connect("uscitp.com", "abarman", "6163957274", "abarman_walkability");

if(mysqli_connect_errno()) {
    echo "Failed to connect to mySql: " . mysqli_connect_errno();
    exit();
}


$sql = "INSERT INTO reviews ". "(neighborhood, score, review) ".
    "VALUES ".
    "('".
    $_REQUEST['neighborhood_name']."', ".
    $_REQUEST['walk_score'].", ".
    "'". $_REQUEST['review'] ."'".
    ")";

$results= mysqli_query($conn, $sql);


if(!$results){
    echo "FORM info " . print_r($_REQUEST) . "<hr>";
    echo "SQL: " . $sql . "<hr>";
    echo "ERROR: ". mysqli_error($conn);
    exit();
} else {
    echo "<br><br><br><div style='font-size: 28pt; text-align: center;'>Thank you!</div>";
    echo "<div style='font-size: 28pt; text-align: center;'>" . "Your new review for <span style='color: #fff100;'>".$_REQUEST['neighborhood_name']."</span> was added." . "</div>" . "</br>";
    //echo "<div>" . "Continue to " . "<a href='search.php'>Home Page</a>" . "</div>";

}

?>

</body>
</html>