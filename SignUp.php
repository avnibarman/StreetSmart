<html>

<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link href="http://allfont.net/allfont.css?fonts=caviar-dreams" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

</head>



<body>

<style>

    div{
        font-family: Raleway;
    }
</style>


<div id="menu">

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

</div>


<div id="signuppage">
    </br>
    </br>

    SIGN UP
    </br></br>



    <form action="confirmation.php" method="get" name="signup">

        <div id="signupform">
            Email:
            <input type="text" name="usersignup">&emsp;&emsp;<hr class="login">
            </br>
        </div>
        </br>

        <div id="signupform">
            Password:
            <input type="password" name="passwordsignup">&emsp;&emsp;&emsp;<hr class="login">
            </br>
        </div>
        </br>


        <input type="submit" value="Sign Me Up!" name="button">

    </form>
</div>
</body>
</html>