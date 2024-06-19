<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Engineering_Projects_Management"


$conn = new mysqli($servername ,$username ,$password ,$dbname);

if($conn->connect_error)
    die("Connection failed: " . $conn->connection_error );



