<?php
// Kết nối cơ sở dữ liệu
include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy đáp án từ form
    $user_answers = isset($_POST['answers']) ? $_POST['answers'] : [];
    $score = 0; // Điểm số ban đầu
    $total_questions = 0;

    // Khởi tạo giao diện
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Kết quả</title>';
    echo '<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">';
    echo '</head>';
    echo '<body>';
    echo '<div class="container mt-5">';
    echo '<h2 class="text-center mb-4">Kết quả</h2>';

    // Duyệt qua từng câu hỏi để kiểm tra đáp án
    foreach ($user_answers as $question_id => $selected_answers) {
        $total_questions++;

        // Lấy đáp án đúng từ cơ sở dữ liệu
        $query = "SELECT id FROM question_answers WHERE question_id = $question_id AND is_correct = 1";
        $result = $conn->query($query);

        $correct_answers = [];
        while ($row = $result->fetch_assoc()) {
            $correct_answers[] = $row['id'];
        }

        // So sánh đáp án người dùng với đáp án đúng
        $is_correct = count(array_diff($correct_answers, $selected_answers)) === 0 &&
                      count(array_diff($selected_answers, $correct_answers)) === 0;

        if ($is_correct) {
            $score++;
        }
    }

    // Hiển thị kết quả
    echo '<div class="alert alert-primary text-center">';
    echo "<h4>Bạn đã trả lời đúng <strong>$score</strong> / $total_questions câu hỏi</h4>";
    echo '</div>';

    // Hiển thị nút làm lại 
    echo '<div class="alert alert-secondary text-center">';
    echo '<a href="index.php" class="btn btn-danger">Làm lại</a>';
    echo '</div>';

    echo '</div>'; // Kết thúc container
    echo '</body>';
    echo '</html>';
}
?>
