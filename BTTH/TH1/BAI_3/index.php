<?php
include "database.php";
$sql = "SELECT * FROM taikhoan";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="icon/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Danh sách sinh viên</h1>
        <table class="table table-bordered table-striped">
            <thead class="table">
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Họ</th>
                    <th>Tên</th>
                    <th>Thành phố</th>
                    <th>Email</th>
                    <th>Khóa học</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Hiển thị dữ liệu
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['username']}</td>";
                        echo "<td>{$row['password']}</td>";
                        echo "<td>{$row['lastname']}</td>";
                        echo "<td>{$row['firstname']}</td>";
                        echo "<td>{$row['city']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['course1']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Không có dữ liệu</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
