<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten = $_POST['ten'];
    $mo_ta = $_POST['mo_ta'];
    $anh = '';

    // Tải ảnh lên thư mục "images"
    if (isset($_FILES['anh']) && $_FILES['anh']['error'] === UPLOAD_ERR_OK) {
        $targetDir = 'images/';
        $fileName = time() . '_' . basename($_FILES['anh']['name']);
        $targetFilePath = $targetDir . $fileName;
        move_uploaded_file($_FILES['anh']['tmp_name'], $targetFilePath);
        $anh = $targetFilePath;
    }

    // Thêm vào CSDL
    $sql = "INSERT INTO flowers (ten, mo_ta, anh) VALUES ('$ten', '$mo_ta', '$anh')";
    $conn->query($sql);

    header('Location: index.php?admin=true');
    exit;
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm loài hoa mới</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Thêm loài hoa mới</h1>
        
        <!-- Form thêm loài hoa -->
        <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="ten" class="form-label">Tên hoa:</label>
                <input type="text" class="form-control" id="ten" name="ten" required>
                <div class="invalid-feedback">
                    Vui lòng nhập tên hoa.
                </div>
            </div>
            <div class="mb-3">
                <label for="mo_ta" class="form-label">Mô tả:</label>
                <textarea class="form-control" id="mo_ta" name="mo_ta" rows="3" required></textarea>
                <div class="invalid-feedback">
                    Vui lòng nhập mô tả.
                </div>
            </div>
            <div class="mb-3">
                <label for="anh" class="form-label">Ảnh:</label>
                <input type="file" class="form-control" id="anh" name="anh" required>
                <div class="invalid-feedback">
                    Vui lòng chọn một ảnh.
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="admin.php" class="btn btn-secondary">Quay lại danh sách</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        // Bootstrap validation
        (function () {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>
</html>
