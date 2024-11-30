<?php include 'header.php'; ?>
<?php include 'products.php'; ?>

<?php
$id = $_GET['id'] ?? null;

if ($id === null || !isset($products[$id])) {
    header('Location: index.php');
    exit;
}

$product = $products[$id];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';

    if ($name && $price) {
        $products[$id] = ['name' => $name, 'price' => $price];
        saveProducts($products);
        header('Location: index.php');
        exit;
    }
}
?>

<div class="container mt-4">
    <h2>Sửa Sản Phẩm</h2>
    <form method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá thành</label>
            <input type="number" name="price" id="price" class="form-control" value="<?= htmlspecialchars($product['price']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="index.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php include 'footer.php'; ?>
