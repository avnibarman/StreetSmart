<?php
session_start();
$user = $_SESSION['user'];

?>

<html>

<head>
    <link href="http://allfont.net/allfont.css?fonts=caviar-dreams" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" ></script>
</head>

<title>Street Smart</title>

<body>

<?php
$conn = mysqli_connect("uscitp.com", "abarman", "6163957274", "abarman_walkability");



if(mysqli_connect_errno()){
    echo "the error is ".mysqli_connect_errno()."";
    exit();
}



$sql = "SELECT * FROM sample_data WHERE 1=1";




if($_REQUEST['name']!="" || $_REQUEST['name']!=" ") {

    $sql = $sql . " AND neighborhood_name LIKE '".$_REQUEST['name']."'";
}




$results = mysqli_query($conn, $sql);

if(!$results) {
    echo "Your SQL: " . $sql . "<br><br>";
    echo "SQL Error: " . mysqli_error($conn);
    exit();
}
?>

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


<div id="main">

    <?php
    //echo "<div><em>Your results returned <strong>" . mysqli_num_rows($results) . "</strong> results.</em></div>";
    //echo "<br><br>";

    while($currentrow = mysqli_fetch_array($results)) {
        echo "<div class='title' id='results' style='width: 30%;'><strong>" .
            "<a class='linktodetail' style='text-align: center !important; padding: 0;' href='details.php?id=" .$currentrow['id']."'>" . "<img class='pin' src='pin.png'>" . $currentrow['neighborhood_name']."</a></strong>".
            " has a ".$currentrow['crime_score']. " crime score". " and a walkability score of ".
            $currentrow['walkability_score']. "</div>".

            "<br style='clear:both;'><br><br><br>";
    }
    ?>

</div>



</body>

</html>