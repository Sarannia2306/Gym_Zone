<?php

//database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitnessdb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    
    die("Connection Failed: " . mysqli_connect_error());
}

?>
