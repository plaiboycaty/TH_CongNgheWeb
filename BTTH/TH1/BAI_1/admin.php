<?php
include 'data.php';
include 'db_connection.php';

// Lấy danh sách hoa từ cơ sở dữ liệu
$sql = "SELECT * FROM flowers";
$result = $conn->query($sql);

$flowers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $flowers[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị danh sách loài hoa</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container my-4">
        <h1 class="text-center">Quản trị danh sách các loài hoa</h1>
        <div class="mb-3 text-end">
            <a href="index.php" class="btn btn-secondary">Chuyển sang giao diện người dùng khách</a>
        </div>
        <div class="mb-3 text-end">
            <a href="add_flower.php" class="btn btn-success">Thêm loài hoa mới</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tên hoa</th>
                    <th>Mô tả</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flowers as $index => $flower): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($flower['ten']) ?></td>
                        <td><?= htmlspecialchars($flower['mo_ta']) ?></td>
                        <td>
                            <img src="<?= $flower['anh'] ?>" alt="<?= htmlspecialchars($flower['ten']) ?>" class="img-thumbnail" style="width: 100px; height: auto;">
                        </td>
                        <td>
                            <a href="edit_flower.php?id=<?= $flower['id'] ?>" class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="delete_flower.php?id=<?= $flower['id'] ?>" class="btn btn-sm btn-primary" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
