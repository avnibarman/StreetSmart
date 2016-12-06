<?php
session_start();
$user = $_SESSION['user'];


if(mysqli_connect_errno()) {
    echo "Failed to connect:" . mysqli_connect_errno();
    exit;
}

$conn = mysqli_connect('uscitp.com', 'abarman', '6163957274', 'abarman_walkability');
$sql = "INSERT INTO users (username, password) VALUES ('".
    $_REQUEST[usersignup]."', '".$_REQUEST[passwordsignup]."')";

$results = mysqli_query($conn, $sql);

?>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link href="http://allfont.net/allfont.css?fonts=caviar-dreams" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>

<title>Street Smart | Log In</title>

<style>
    div{
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

<div id="loginpage">
    </br>
    </br>

    LOG IN
    </br>
    </br>



    <form action="review.php" method="get" name="login">
        <input type="hidden" name="id" value="<?$_REQUEST['id'];?>">
        <div id="loginform">
            Username:
            <input type="text" name="user">&emsp;&emsp;&emsp;<hr class="login">
            </br>
        </div>
        </br>

        <div id="loginform">
            Password:
            <input type="password" name="password">&emsp;&emsp;&emsp;<hr class="login">
            </br>
        </div>
        </br>
        <!--        <div id="pw">-->
        <!--            Username:-->
        <!--            <input type="password" name="password"><hr>-->
        <!--            </br>-->
        <!--        </div>-->
        <!--        </br>-->

        <input type="submit" value="Log In">

    </form>
</div>
</body>
</html>