<?php
include 'db_connection.php';

// Kiểm tra ID từ URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID không hợp lệ hoặc không tồn tại trong URL.");
}
$id = (int)$_GET['id'];

// Kiểm tra kết nối cơ sở dữ liệu
if (!$conn) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Xóa bản ghi
$sql = "DELETE FROM flowers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header('Location: admin.php'); // Chuyển hướng về trang quản trị
    exit;
} else {
    die("Lỗi khi xóa bản ghi: " . $stmt->error);
}
?>
