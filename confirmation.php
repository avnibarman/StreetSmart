<?php
if(mysqli_connect_errno()) {
    echo "Failed to connect:" . mysqli_connect_errno();
    exit;
}

$conn = mysqli_connect('uscitp.com', 'abarman', '6163957274', 'abarman_walkability');

$sql = "INSERT INTO users (username, password) VALUES ('".
    $_REQUEST[usersignup]."', '".$_REQUEST[passwordsignup]."')";

$results = mysqli_query($conn, $sql);


echo "Your account was created! You may now submit reviews. Log in to continue" . "</br></br>";

echo "<form action='LoginPage.php'><input type='submit' value='Continue'></br></form>";


?>