<?php


$host = 'localhost'; // Change this to the actual hostname or IP of the database server
$username = 'id21151727_root';
$password = 'e38492F@ejrqerqjriqjrqrjqr';
$database = 'id21151727_livestore';

$con = mysqli_connect($host, $username, $password, $database);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    // You might want to handle the error in a better way
}
else{
    echo "succesfully connected";
}

?>

<!-- 

M- Database
V- Front-end
C- Logic 
 -->