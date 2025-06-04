<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "logdb";
$conn = "";

try{
$conn = mysqli_connect($db_server, $db_user,
                       $db_pass, $db_name);
} catch(Exception $conn){
    echo "Cannot connect to server!";
}
?>
