<?php
$productsFile = 'products.json';

// Đọc dữ liệu từ file JSON
if (file_exists($productsFile)) {
    $products = json_decode(file_get_contents($productsFile), true);
    if (!is_array($products)) {
        $products = [];
    }
} else {
    $products = [];
}

// Hàm lưu dữ liệu vào file JSON
function saveProducts($products) {
    global $productsFile;
    file_put_contents($productsFile, json_encode($products, JSON_PRETTY_PRINT));
}
?>
