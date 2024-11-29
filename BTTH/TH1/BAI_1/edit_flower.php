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

// Lấy dữ liệu từ cơ sở dữ liệu
$sql = "SELECT * FROM flowers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Không tìm thấy bản ghi với ID: " . $id);
}

$flower = $result->fetch_assoc();

// Xử lý cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten = $_POST['ten'];
    $mo_ta = $_POST['mo_ta'];
    $anh = $flower['anh']; // Ảnh mặc định nếu không tải ảnh mới

    // Kiểm tra và tải ảnh mới
    if (isset($_FILES['anh']) && $_FILES['anh']['error'] === UPLOAD_ERR_OK) {
        $targetDir = 'images/';
        $fileName = time() . '_' . basename($_FILES['anh']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Chỉ chấp nhận ảnh hợp lệ
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileType, $allowedTypes) && move_uploaded_file($_FILES['anh']['tmp_name'], $targetFilePath)) {
            $anh = $targetFilePath;
        } else {
            die("Lỗi khi tải ảnh hoặc định dạng không hợp lệ.");
        }
    }

    // Cập nhật dữ liệu
    $sql = "UPDATE flowers SET ten = ?, mo_ta = ?, anh = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $ten, $mo_ta, $anh, $id);

    if ($stmt->execute()) {
        header('Location: admin.php'); // Chuyển hướng về trang quản trị
        exit;
    } else {
        die("Lỗi khi cập nhật dữ liệu: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa hoa</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h1>Chỉnh sửa thông tin hoa</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="ten" class="form-label">Tên hoa</label>
                <input type="text" id="ten" name="ten" class="form-control" value="<?= htmlspecialchars($flower['ten']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="mo_ta" class="form-label">Mô tả</label>
                <textarea id="mo_ta" name="mo_ta" class="form-control" required><?= htmlspecialchars($flower['mo_ta']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Ảnh hiện tại</label><br>
                <img src="<?= htmlspecialchars($flower['anh']) ?>" alt="Ảnh hoa" class="img-thumbnail" style="width: 150px; height: auto;">
            </div>
            <div class="mb-3">
                <label for="anh" class="form-label">Tải ảnh mới (nếu có)</label>
                <input type="file" id="anh" name="anh" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
