<?php include('config.php'); ?>
<h2>📝 Upload Quiz Questions</h2>
<form method="POST">
    <input name="course_id" placeholder="Course ID" required><br>
    <input name="title" placeholder="Quiz Title" required><br>
    <textarea name="questions" placeholder="Enter questions separated by line breaks" required></textarea><br>
    <button name="upload">Upload</button>
</form>

<?php
if (isset($_POST['upload'])) {
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $questions = explode("\n", trim($_POST['questions']));
    $conn->query("INSERT INTO quizzes (course_id, title, created_by) VALUES ('$course_id', '$title', 'admin')");
    $quiz_id = $conn->insert_id;
    foreach ($questions as $q) {
        $q = trim($q);
        if ($q) $conn->query("INSERT INTO quiz_questions (quiz_id, question_text) VALUES ('$quiz_id', '$q')");
    }
    echo "✅ Quiz uploaded successfully!";
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