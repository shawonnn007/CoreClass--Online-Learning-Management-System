<?php include('config.php'); ?>
<h2>📖 Student Reviews</h2>
<table>
<tr><th>Course ID</th><th>Student ID</th><th>Comment</th></tr>
<?php
$discussions = $conn->query("SELECT * FROM discussions ORDER BY created_at DESC");
while ($d = $discussions->fetch_assoc()) {
    echo "<tr><td>{$d['course_id']}</td><td>{$d['student_id']}</td><td>{$d['content']}</td></tr>";
}
?>
</table>

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