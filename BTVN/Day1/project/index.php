<?php include 'header.php'; ?>
<?php include 'products.php'; ?>

<div class="container mt-4">
    <h2 class="text-center">Danh Sách Sản Phẩm</h2>
    <a href="add_product.php" class="btn btn-success mb-3">Thêm mới</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá thành</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
        <?php
                    include "connection.php";

                    $sql = "select * from product";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($result))
                    {?>
                        <tr>
                            <td><?php echo $row['name']?> </td>
                            <td><?php echo $row['price']?> </td>
                            <td><a href="update.php?name=<?= urlencode($product['name']) ?>&price=<?= $product['price'] ?>" class="text-primary "><i class="bi bi-pencil-square"></i></a></td>
                            <td><a href="delete.php?name=<?= urlencode($product['name']) ?>&price=<?= $product['price'] ?>" class="text-primary" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');"><i class="bi bi-trash-fill"></i></a></td>
                        </tr>
                <?php
                    }
                ?>
        </tbody>  
    </table>
</div>

<?php include 'footer.php'; ?>
