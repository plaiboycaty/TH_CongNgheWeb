<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'qlsp';

$conn = new mysqli($host, $user, $password, $database);

if($conn)
{
    mysqli_query($conn, "SET NAMES 'utf8' ");
    
}
else 
{
    echo 'Kết nối thất bại';
}
?>