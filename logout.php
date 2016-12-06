<?php
session_start();
unset($_SESSION["user"]);
unset($_SESSION["password"]);

//echo 'You have cleaned session.' . '</br>';

session_destroy();
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
<br>
<br>
<div style="text-align: center; font-size: 28pt;">You have logged out.</div>
</body>
</html>
