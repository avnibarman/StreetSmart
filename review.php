<?php
session_start();
$user = $_REQUEST['user'];
$_SESSION['user'] = $user;

$id = $_SESSION['id'];

$conn = mysqli_connect('uscitp.com', 'abarman', '6163957274', 'abarman_walkability');

?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link href="http://allfont.net/allfont.css?fonts=caviar-dreams" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>

<style>
    div{
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
    echo "<span style='font-family: Raleway;'>Welcome, " . $user . ".</span>";
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
        echo "<div style='font-family: Raleway;'>Successfully Logged In!</div>";
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

if(empty($id)) {
    echo "<br><br><br><div style='text-align: center;'><h3><span style='line-height: 2; text-align: center;'>Please use the  <a href='search.php' style='text-decoration: underline; padding: 0;'>search</a> page.</span></h3></div>";
    exit();
}

if(mysqli_connect_errno()) {
    echo "Failed to connect to mySql: " . mysqli_connect_errno();
    exit();
}

$sql = "SELECT * FROM sample_data WHERE id = ".
    $id;

$results = mysqli_query($conn, $sql);

if(!$results) {
    echo "Your SQL: " . $sql . "<br><br>";
    echo "SQL Error: " . mysqli_error($conn);
    exit();
}

while($currentrow = mysqli_fetch_Array($results)){
?>

<div id="reviews" style="margin-top: 100px;">
    <form action = "insertreview.php" style="width: 60%; padding: 2%; margin-left: 18%; margin-right: 18%; border: solid 2px #fff100;">
        <?php
        echo "<input type = 'hidden' name='neighborhood_name' value ='".$currentrow['neighborhood_name']."''>";
        echo " <b style='font-size: 36pt; color: #fff100;'>".$currentrow['neighborhood_name']."</b>";
        ?>
        <br>
        Walkability Score: <select name="walk_score">
            <?php
            for ($i = 1; $i < 8; $i++){
                echo "<option value=". $i .">" . $i ."</option>";
            }

            ?>
        </select>
        <br>
        <input type="text" name="review" style="border: 1px solid white !important; margin-top: 0 !important; width: 100%; height: 100px; font-size: 20pt; ">

        <br>
        <input type="submit">
    </form>
</div>

<?php
   }
?>
</body>
</html>