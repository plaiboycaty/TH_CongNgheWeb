<?php
$host = 'localhost';  // Hoặc máy chủ của bạn
$username = 'root';   // Tên đăng nhập cơ sở dữ liệu
$password = '';       // Mật khẩu cơ sở dữ liệu (nếu có)
$dbname = 'quiz_db';  // Tên cơ sở dữ liệu

// Kết nối cơ sở dữ liệu
$conn = new mysqli($host, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>