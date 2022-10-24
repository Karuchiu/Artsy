<?php 

$host = "localhost";
$username = "root";
$password = "";
$database = "artsy";

//Create a database connection
$con = mysqli_connect($host, $username, $password, $database);

//Check the connection
if(!$con)
{
    die("Connection failed: ". mysqli_connect_error());
}
else{
    echo "Connected successfully";
}

?>