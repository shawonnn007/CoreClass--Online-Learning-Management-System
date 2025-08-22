<?php include('config.php'); ?>
<h2>💬 Course Discussions</h2>
<form method="POST">
    <input name="course_id" placeholder="Course ID" required><br>
    <input name="student_id" placeholder="Your ID" required><br>
    <textarea name="content" placeholder="Your comment" required></textarea><br>
    <button name="post">Post</button>
</form>

<?php
if (isset($_POST['post'])) {
    $conn->query("INSERT INTO discussions (course_id, student_id, content) VALUES ('{$_POST['course_id']}', '{$_POST['student_id']}', '{$_POST['content']}')");
    echo "✅ Posted!";
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