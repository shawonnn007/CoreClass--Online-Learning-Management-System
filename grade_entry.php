<?php
include('config.php');


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $student_id = intval($_POST['student_id']);
    $course_id  = intval($_POST['course_id']);
    $grade      = $conn->real_escape_string($_POST['grade']);

    
    $check = $conn->query("SELECT course_title FROM courses WHERE course_id = $course_id");
    if ($check->num_rows === 0) {
        echo "<p style='color:red;'>❌ Invalid Course ID.</p>";
    } else {
        $conn->query("INSERT INTO grades (student_id, course_id, grade) VALUES ($student_id, $course_id, '$grade')");
        echo "<p style='color:green;'>✅ Grade recorded for Student ID: <strong>$student_id</strong> in Course ID: <strong>$course_id</strong>!</p>";
    }
}
?>

<h2>🧮 Enter Grades</h2>
<form method="POST">
    <label>Student ID</label>
    <input name="student_id" placeholder="Student ID" required><br>

    <label>Select Course</label>
    <select name="course_id" required>
        <option value="">-- Select Course --</option>
        <?php
        $courses = $conn->query("SELECT course_id, course_title FROM courses");
        while ($row = $courses->fetch_assoc()) {
            echo "<option value='{$row['course_id']}'>{$row['course_title']} (ID: {$row['course_id']})</option>";
        }
        ?>
    </select><br>

    <label>Grade</label>
    <input name="grade" placeholder="Grade (e.g. A+)" required><br>

    <button name="submit">Submit Grade</button>
</form>

<style>
body { font-family: Arial; background: #f7f9fc; padding: 20px; color: #333; }
input, select, button {
    width: 100%; padding: 10px; margin: 10px 0;
    border-radius: 4px; border: 1px solid #ccc;
}
button { background: #4CAF50; color: white; font-weight: bold; }
h2 { color: #4CAF50; }
</style>
