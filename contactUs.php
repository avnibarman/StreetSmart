<?php

session_start();
$user = $_SESSION['user'];

if(!empty($_REQUEST["email"])){
    $recipient="nnagda@usc.edu";
    $subject="Customer Feedback";

    $message=$_REQUEST["email"]."\r\n\r\n"."Message: ";
    $message.=$_REQUEST["comment"]."\r\n\r\n"."Name: ";
    $message.=$_REQUEST["name"];

    //$message.=$currentrow['Date']. "\r\n"
    $test = mail($recipient,"Customer Inquiry",$message);
    If($test==1){
        echo "Email sent" . "</br>";
        echo "Return to ";
        echo "<a href='../final_milestone/search.php'>Home Page</a>";
        exit();
    }
    else{
        echo "Email failed";
    }
}

?>

<html>
<head>
    <link href="http://allfont.net/allfont.css?fonts=caviar-dreams" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">

    <title>Street Smart | Contact Us</title>

</head>


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

</br></br></br>
<div id="message">
Shoot us a message!<br><br>We would love to hear from you.</br></br>
</div>
<form id="contactBox">
    </br><input type="textarea" name="name" id="formBox" placeholder="Name"><br>
    </br><input type="textarea" name="email" id="formBox"placeholder="Email Address"><br>
    </br><textarea name="comment" id="textBox"placeholder="Comment"></textarea><br>
    <input type="submit" id="submitButton">
</form>





</body>
</html>

