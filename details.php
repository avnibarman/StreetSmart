<?php
session_start();
$user = $_SESSION['user'];
$id = $_SESSION['id'];

$id = $_REQUEST['id'];
$_SESSION['id'] = $id;

?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link href="http://allfont.net/allfont.css?fonts=caviar-dreams" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="mapStylesheet.css">
    <script src= "https://cdn.zingchart.com/zingchart.min.js"></script>
    <script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script>


    <style>

        div{
            font-family: 'Raleway';
            bborder: 1px solid red;
        }

        #myChart{
            width: 80%;
            margin-right: 10%;
            margin-left: 10%;
        }

        #reviews{
            width:60%;
            margin-left: 20%;
            margin-right: 20%;
        }

        #reviewButton{
            width:40%;
            padding:1%;
            font-family: "Caviar Dreams";
            font-size: 15pt;
            float:right;
            margin-right:5%;
            border-radius: 10px;
        }

        #questionMark{
            color:white;
            background-color:black;
            font-family: "Caviar Dreams";
            float:right;
            moz-border-radius: 85px;
            -webkit-border-radius: 85px;
            font-size: 10pt;
        }

        #questionText{
            float:right;
            font-family: "Caviar Dreams";
        }

        #reviewPreview{
            float:left;
            font-family: Raleway;
            width:48%;
            margin-bottom: 3%;
            margin-left: 7%;
            color:#FFF200;
            text-align: left;

        }

        .tableEdit{
            color:white;
            background-color: #333333;
            padding: 1%;
        }

        #table{
            border: 2px solid #fff100;
            width: 80%;
            margin-left: 10%;
            margin-right: 10%;
            padding: 0.5%;
            font-family: Raleway;
        }
        #buttonRight{
            width: 100%;
        }

        #loginorsignup{
            width: 80%;
            margin-left: 10%;
            margin-right: 10%;
            line-height: 0;
        }
    </style>
</head>


<title>Street Smart</title>
<body>

<div id="menubar">
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
<br><br>


<?php
$conn = mysqli_connect("uscitp.com", "abarman", "6163957274", "abarman_walkability");


if(mysqli_connect_errno()) {
    echo "Failed to connect to mySql: " . mysqli_connect_errno();
    exit();
}

$sql = "SELECT * FROM sample_data WHERE id = ".
    $_REQUEST['id'];

$results = mysqli_query($conn, $sql);

if(!$results) {
    echo "Your SQL: " . $sql . "<br><br>";
    echo "SQL Error: " . mysqli_error($conn);
    exit();
}

$currentNeighborhood;

while($currentrow = mysqli_fetch_Array($results)){
?>

    <div id="topline">You are located in the
        <strong><?php echo " " . $currentrow['neighborhood_name']; $currentNeighborhood=$currentrow['neighborhood_name']?></strong>
        Neighborhood.
    </div>


<?php $crimeScore= $currentrow['crime_score'];

if($crimeScore == "low") {
    $crimeScore=25;
}
if($crimeScore=="medium") {
    $crimeScore=50;
}
if($crimeScore=="high") {
    $crimeScore=100;
}

?>

<?php $incomeScore =$currentrow['income_score'];

if($incomeScore == "0 - 45,000"){
    $incomeScore=25;
}
if($incomeScore =="46,000 - 90,000"){
    $incomeScore=50;
}
if($incomeScore =="91,000 - 135,000"){
    $incomeScore=75;
}
if($incomeScore =="136,000 - 180,000"){
    $incomeScore=100;
} ?>


<?php $walkabilityScore=$currentrow['walkability_score'];

$walkabilityScore=((int)$walkabilityScore/7)*100;

?>

    </div>



    <div id="address" style="display: none;"><?php echo $currentrow["neighborhood_name"]?></div>

    <script>
        var geocoder;
        var map;
        var address = document.getElementById("address").innerHTML;

    </script>
    <script src="mapScript.js"></script>

        <div id="map_canvas" style="color: black !important; width: 80%; margin-left: 10%; margin-right: 10%; height: 300px; margin: auto;"></div>



    <div id='myChart'>


        <script>


            var walkabilityScore="<?=$walkabilityScore;?>";
            var crimeScore= "<?=$crimeScore;?>";
            var incomeScore= "<?=$incomeScore;?>";
            console.log("walkabilityScore="+walkabilityScore+ " crimeScore="+crimeScore + " incomeScore="+incomeScore);

            var myConfig =
            {
                "type": "hbar",
                "font-family": "caviar-dreams",
                "background-color": "black",
                "title": {
                    "font-family": "caviar-dreams",
                    "background-color": "black",
                    "font-color": "#A4A4A4",
                    "font-size": "16px"
                },
                "plot": {
                    "bars-overlap": "100%",
                    "hover-state": {
                        "visible": false
                    },
                    "animation": {
                        "delay": 300,
                        "effect": 4,
                        "speed": "500",
                        "method": "0",
                        "sequence": "3"
                    }
                },
                "plotarea": {
                    "margin": "15px 10px 50px 140px"
                },
                "scale-x": {
                    "line-color": "none",
                    "values": ["Walkability Score", "Average Income", "Crime Rate"],
                    "tick": {
                        "visible": false
                    },
                    "guide": {
                        "visible": false
                    },
                    "item": {
                        "font-size": "16px",
                        "font-family":"Raleway",
                        "padding-right": "5px",
                        "auto-align": true,
                        "background-color": "black",
                        "rules": [{
                            "rule": "%i==0",
                            "font-color": "#FFF200"
                        }, {
                            "rule": "%i==1",
                            "font-color": "#FFFFFF"
                        }, {
                            "rule": "%i==2",
                            "font-color": "#B3B3B3"
                        }

                        ]
                    }
                },
                "scale-y": {
                    "visible": true,
                    "guide": {
                        "visible": false
                    }
                },
                "series": [{
                    "values": [100, 100, 100],
                    "background-color": "black",
                    "border-color": "black",

                    "tooltip": {
                        "visible": false
                    }
                }, {
                    "values": [<?=$walkabilityScore;?>,<?=$incomeScore;?>,<?=$crimeScore;?>],
                    "bar-width": "35%",
                    "max-trackers": 0,
                    "rules": [{
                        "rule": "%i==0",
                        "background-color": "#FFF200"
                    }, {
                        "rule": "%i==1",
                        "background-color": "#FFFFFF"
                    }, {
                        "rule": "%i==2",
                        "background-color": "#B3B3B3"
                    }]
                }]
            }


            zingchart.render({
                id : 'myChart',
                data : myConfig,
                height: 300,
                width: 1000
            });
        </script>

    </div>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7lkCIT7q5wG3FjeWQfUmDY18MZUNM4ck&libraries=places&callback=initialize"
                                    async defer></script>
        </div>

    <?php
}
?>



</body></html>
<?php

$reviewResults = "SELECT * FROM reviews WHERE reviews.neighborhood='" . "$currentNeighborhood" . "'";
$results = mysqli_query($conn, $reviewResults);

if(!$results) {
    echo "Your SQL: " . $sql . "<br><br>";
    echo "SQL Error: " . mysqli_error($conn);
    exit();
}

if(empty($_REQUEST["start"]))
{ $start=1; }
else
{ $start = $_REQUEST["start"]; }

$end = $start + 2;

if (mysqli_num_rows($results) < $end)
{ $end = mysqli_num_rows($results); }

$counter = $start;

mysqli_data_seek($results,$start-1);



echo "<br><br>";

if(empty($_REQUEST["start"])){
    $start=1;
}
else{
    $start=$_REQUEST["start"];
}

$count=3;
$end=$start+$count-1;
$counter=$start;

?>


<table id="table">
    <th><?echo "Walkability Score";?></th>
    <th><? echo "Reviews from Users";?></th>
    <?
    while($currentrow = mysqli_fetch_array($results)) {
        ?>
        <tr>
            <td class="tableEdit"><?echo $currentrow['score'];?></td>
            <td class="tableEdit"><?echo $currentrow['review'];?></td>
        </tr>

        <?php

        if ($counter>=$end){
            break;
        }
        $counter++;
    }

    ?>
</table>

<div id="displayresults" style="width: 80%; margin-left: 10%; margin-right: 10%; text-align: right; line-height: 1;">

    <?php

    //echo "Displaying records ".$start." through ".$end;
    echo "<div style='width: 100%;'>";

    if($start!=1){
        echo"<a href='details.php?id=" .$_REQUEST['id']."&start=".
            ($start -$count). "' style='text-align: left; width: 50%;'>Previous</a>";

    }

    if($end<mysqli_num_rows($results)){
        echo"<a href='details.php?id=" .$_REQUEST['id']."&start=".
            ($end +1)."' style='width: 50%; text-align: left;'>Next</a>";
    }

    echo "</div>";
    mysqli_data_seek($results,$start-1);

    ?>

</div>


<form action="review.php">
    <input type="hidden" name="id" value="<?php echo $neighborhoodID['id'];?>">
</form>



    <?php

    if(empty($user)){
        $_SESSION["loggedin"] = "no";
        $_SESSION['admin'] = 'no';

        echo "<h3 style='margin: auto; width: 80%; margin-left: 10%; margin-right: 10%; text-align: left; display: block; font-family: Raleway;'>To Submit a Review</h3>";

        echo "<div id='loginorsignup' class='smallfont' style='margin: auto; display: block';>" .
            "<form action='LoginPage.php' style = 'width: 10%;  margin: 0px; margin-right: 0px; float: left'>" . "<input type='hidden' name='id' value=" .
            $_REQUEST['id'] . ">" . "<input type='submit' value='Log In'>" . "</form><br>" .
            "<form action='SignUp.php' style = 'width: 10%; margin: 0px; margin-right: 0px; float: left'><input type='submit' value='Sign Up'></form></div>";
        exit();
    }

    else if(!empty($user)) {
        $_SESSION["loggedin"] = "yes";
        echo "<div id='reviews' style='margin-left: 10%;'><h2>" .
            "<form action='review.php'>" .
            "<input type='hidden' name='id' value=" . $_REQUEST['id'] .">" .
            "<input type='hidden' name='user' value=" . $user .">" .
            "<input type='hidden' name='pw' value=" . $_REQUEST['password'] .">" .
            "<input type='submit' value='Submit a Review'></form></h2></div>";
    }

    ?>
</body>
</html>