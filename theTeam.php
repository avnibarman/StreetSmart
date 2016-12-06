<?php
session_start();
$user = $_SESSION['user'];
?>
<html>
<head>
    <link href="http://allfont.net/allfont.css?fonts=caviar-dreams" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <title>Street Smart | About</title>

</head>

<style>
    body{
        font-family: Raleway;
    }


    @media screen and (max-width: 570px) {
        .email{
            font-size: 8pt;
        }
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



<div id="outerBox">



        <div class="heading">
            <br><br><br>
            Our Mission
        </div>
        <br>
        <div class="mission">
            Street Smart provides Los Angeles natives, explorers, and college students a stunning visual database of LA neighborhoods and their relative "walkability scores".
            Our streamlined interface allows for easy searching and reviewing. While other map applications provide the quickest walking route to a destination, we
            provide the background safety check of the area you are about to explore.
        </div>
    <br> <br>
        <img src="walkable.png" style="width: 50%; border: 2px solid white;">

    <div class="heading">
        <br><br><br>
        The Team
    </div>

    <div style="width: 80%; text-align: center; height: 500px; padding-right: 10%; padding-left: 10%; padding-top: 3%;">

    <div class="personBox">
        <img src="187.png" class="profpic">
        </br>
        </br>
        Avni Barman

        <div class="desBox">
            <br>
            <span class="email">abarman@usc.edu</span>
        </div>
    </div>

    <div class="personBox">
        <img src="187a.png" class="profpic">
        </br>
        </br>
        Naylee Nagda
        <div class="desBox">
            <br>
            <span class="email">nnagda@usc.edu</span>
        </div>
    </div>
    <div class="personBox">
        <img src="187b.png" class="profpic">
        </br>
        </br>
        Brianna Doyle
        <div class="desBox">
            <br>
            <span class="email">briannad@usc.edu</span>
        </div>
    </div>
    </div>

</div>


</body>




</html>