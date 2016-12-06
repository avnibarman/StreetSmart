<?php
session_start();
$user = $_SESSION['user'];

?>

<html>
<head>

    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link href="http://allfont.net/allfont.css?fonts=caviar-dreams" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

</head>

<style>
    body{
        font-family: Raleway;
    }
</style>
<?php


if($_REQUEST['logout'] == "logout"){
    $_SESSION["loggedin"] = "no";
    $_SESSION['admin'] = 'no';
    echo "<body><div id='main'>";
    echo "Successfully Logged Out.";
    echo "</br></br>";
    echo "<form action='LoginPage.php'><input type='submit' value='return to login'></form>";
    echo "</div></body>";
    exit();
}

if($_SESSION["loggedin"] == "yes") {
    // all good
    echo "Welcome, admin.";
}
else if (!empty($_REQUEST["password"])) {

    $userVar = $_REQUEST['user'];

    $sql = "SELECT password, idAdmin FROM users WHERE username = '".$userVar."'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result)){
        $passFromDB = $row["password"];
        $idAdmin = $row["idAdmin"];
    }
    if($_REQUEST["password"]== $passFromDB) {
        // VALID login
        $_SESSION["loggedin"]="yes";
        if ($idAdmin == 'yes'){
            $_SESSION['admin'] = 'yes';
        }
        echo "Successfully Logged In!";
    }
    else {
        // INVALID login
        echo "ERROR. WRONG PASSWORD";
        echo "<br><br>";
        echo "<form action='LoginPage.php'><input type='submit' value='return to login'></form>";

        exit();
    }
}
else 	{
    // include login form
    include "LoginPage.php";
    exit();
    // STOP the page
}
?>

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
$conn = mysqli_connect("uscitp.com", "abarman", "6163957274", "abarman_walkability");

if(mysqli_connect_errno()){
    echo "the error is ".mysqli_connect_errno()."";
    exit();
}

$sql = "SELECT * FROM sample_data WHERE 1=1";

if($_REQUEST['name']!="") {
    $sql = $sql . " AND neighborhood_name LIKE '%".$_REQUEST['name']."%'";
}


$results = mysqli_query($conn, $sql);

if(!$results) {
    echo "Your SQL: " . $sql . "<br><br>";
    echo "SQL Error: " . mysqli_error($conn);
    exit();
}


?>

<div id="main">

    <?php
    //echo "<div><em>Your results returned <strong>" . mysqli_num_rows($results) . "</strong> results.</em></div>";
    //echo "<br><br>";

    while($currentrow = mysqli_fetch_array($results)) {
        echo "<div class='title' id='results' style='width: 30%;'><strong>" .
            "<a class='linktodetail' style='text-align: center !important; padding: 0;' href='details.php?id=" .$currentrow['id']."'>" . "<img class='pin' src='pin.png'>" . $currentrow['neighborhood_name']."</a></strong>".
            " has a ".$currentrow['crime_score']. " crime score". " and a walkability score of ".
            $currentrow['walkability_score']. "</div>".
            "<div style='font-size: 14pt;'>" . "<a href='edit.php?id=".$currentrow['id'].
            "'>[Edit]</a>"."<a href='delete.php?id=".$currentrow['id'].
            "'>[Delete]</a>" . "</div>".
            "<br><br><br>";
    }
    ?>

</div>

</body>
</html>
