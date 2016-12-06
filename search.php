<?php
session_start();
$user = $_SESSION['user'];


$conn = mysqli_connect('uscitp.com', 'abarman', '6163957274', 'abarman_walkability');

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

<script>

</script>



<body>
<!--animation-->
<script>
    $( document ).ready(function() {

        $("#pin").hide();

    });
    $(document).ready(function($){
        setTimeout(function(){
            $('.trans--grow').addClass('grow');
            $("#pin").show(800);
        }, 275);
    });

</script>

<style>
    body{
        font-family: Raleway;
    }
</style>

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

    <div id="question">
        </br>
        <p id="where">Where are you walking?</p><br>

    </div>


<!--    <form name="form" action = "result.php" action="details.php">-->

        <?php
        if ($_SESSION['admin'] == 'yes') {
            echo "<form name='form' action = 'result_admin.php'>";
        } else {
            echo "<form name='form' action = 'result.php'>";
        }
        ?>

        <div id="autoComplete">
            <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB7lkCIT7q5wG3FjeWQfUmDY18MZUNM4ck&libraries=places,geometry"></script>

            <script src="autoSuggest.js"></script>
            <div>
                    <input type="text" id="name" name="fulladdress" id="fulladdress" style="width: 45%; font-size:12pt" value=""/>
                    <hr id="thread" class="trans--grow hr2">

                    <input type="hidden" id="receivedLocation" name="name">

                    <div id="icon2"><img src="pin.png"id="pin"></div>

                    <input type="submit" value="WALK">

        </div>
    </form>
    <br style="clear:both"/>


</div>

</body>
</html>
