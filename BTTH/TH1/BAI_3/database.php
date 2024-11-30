<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'qltk';

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