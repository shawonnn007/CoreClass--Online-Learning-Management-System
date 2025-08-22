<?php include('config.php'); ?>
<h2>📘 Available Quizzes</h2>
<form method="POST" enctype="multipart/form-data">
    <select name="quiz_id" required>
        <?php
        $quizzes = $conn->query("SELECT quiz_id, title FROM quizzes");
        while ($q = $quizzes->fetch_assoc()) {
            echo "<option value='{$q['quiz_id']}'>{$q['title']}</option>";
        }
        ?>
    </select><br>
    <input type="number" name="student_id" placeholder="Your Student ID" required><br>
    <input type="file" name="answer_pdf" accept=".pdf" required><br>
    <button name="submit">Submit Answer</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $quiz_id = $_POST['quiz_id'];
    $student_id = $_POST['student_id'];
    $file = $_FILES['answer_pdf'];
    $path = "uploads/" . basename($file['name']);
    move_uploaded_file($file['tmp_name'], $path);
    $conn->query("INSERT INTO quiz_submissions (quiz_id, student_id, file_path) VALUES ('$quiz_id', '$student_id', '$path')");
    echo "✅ Submission uploaded!";
}
?>

<style>
body { font-family: Arial; background: #f7f9fc; padding: 20px; color: #333; }
input, textarea, select, button {
    width: 100%; padding: 10px; margin: 10px 0;
    border-radius: 4px; border: 1px solid #ccc;
}
button { background: #4CAF50; color: white; font-weight: bold; }
h2 { color: #4CAF50; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { padding: 10px; border-bottom: 1px solid #ddd; }
</style>