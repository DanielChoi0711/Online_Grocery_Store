<?php
$servername = "localhost";
$username = "root"; 
$password = "root"; 
$dbname = "assignment1"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

?> 