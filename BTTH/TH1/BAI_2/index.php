<?php
// Kết nối cơ sở dữ liệu
include_once('config.php');

// Lấy danh sách câu hỏi từ cơ sở dữ liệu
$query = "SELECT * FROM questions";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Câu Hỏi Trắc Nghiệm</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Câu Hỏi Trắc Nghiệm</h2>
    
    <!-- Form câu hỏi -->
    <form method="POST" action="process_answers.php">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title"><?= htmlspecialchars($row['question_text']) ?></h4>
                    <?php
                    // Lấy danh sách đáp án tương ứng với câu hỏi
                    $question_id = $row['id'];
                    $answer_query = "SELECT * FROM question_answers WHERE question_id = $question_id";
                    $answer_result = $conn->query($answer_query);
                    ?>
                    <?php while ($answer = $answer_result->fetch_assoc()): ?>
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="answers[<?= $question_id ?>][]" 
                                value="<?= $answer['id'] ?>"
                                id="answer<?= $answer['id'] ?>"
                            >
                            <label class="form-check-label" for="answer<?= $answer['id'] ?>">
                                <?= htmlspecialchars($answer['answer_text']) ?>
                            </label>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endwhile; ?>
        <button type="submit" class="btn btn-primary">Nộp bài</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>>
</body>
</html>
