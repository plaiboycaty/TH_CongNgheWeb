<?php include 'header.php'; ?>
<?php include 'products.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';

    if ($name && $price) {
        $products[] = ['name' => $name, 'price' => $price];
        saveProducts($products);
        header('Location: index.php');
        exit;
    }
}
?>

<div class="container mt-4">
    <h2>Thêm Sản Phẩm</h2>
    <form method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá thành</label>
            <input type="number" name="price" id="price" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
        <a href="index.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php include 'footer.php'; ?>
