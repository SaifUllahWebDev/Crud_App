<?php
$server = 'localhost';
$user  = 'root';
$pass = '';
$db = 'crud';

$conn = new mysqli($server,$user,$pass,$db);

if($conn->connect_error){
    die("connection:failed" . $conn->connect_error );
}



?>