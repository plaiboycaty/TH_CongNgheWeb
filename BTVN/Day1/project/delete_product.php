<?php include 'products.php'; ?>

<?php
$id = $_GET['id'] ?? null;

if ($id !== null && isset($products[$id])) {
    unset($products[$id]);
    saveProducts($products);
}

header('Location: index.php');
exit;
?>
