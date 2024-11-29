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
    <title>Danh sách các loài hoa</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h1 class="text-center">Danh sách các loài hoa</h1>
        <div class="text-end mb-3">
            <a href="admin.php" class="btn btn-primary">Chuyển sang giao diện quản trị</a>
        </div>
        <div class="row">
            <?php foreach ($flowers as $flower): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?= $flower['anh'] ?>" class="card-img-top" alt="<?= htmlspecialchars($flower['ten']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($flower['ten']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($flower['mo_ta']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
