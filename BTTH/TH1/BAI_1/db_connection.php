<?php
$host = 'localhost'; // Máy chủ
$username = 'root';  // Tài khoản MySQL mặc định
$password = '';      // Mật khẩu (thường để trống trên XAMPP)
$database = 'flower_management'; // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($host, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
