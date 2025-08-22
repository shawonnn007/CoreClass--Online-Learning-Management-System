<?php
include('config.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enroll'])) {
    $student_id = $_POST['student_id'];
    $course_title = $_POST['course_title'];


    $stmt = $conn->prepare("SELECT course_id FROM courses WHERE course_title = ?");
    $stmt->bind_param("s", $course_title);
    $stmt->execute();
    $result = $stmt->get_result();
    $course = $result->fetch_assoc();
    $stmt->close();

    if ($course) {
        $course_id = $course['course_id'];

        $insert = $conn->prepare("INSERT INTO enrollments (student_id, course_id) VALUES (?, ?)");
        $insert->bind_param("ii", $student_id, $course_id);
        $insert->execute();
        $insert->close();

        echo "✅ Student enrolled in <strong>$course_title</strong>!";
    } else {
        echo "❌ Course not found!";
    }
}
?>

<style>
    body { font-family: 'Segoe UI'; background: #f4f4f4; margin: 40px; color: #333; }
    h2 { color: #4CAF50; }
    form, table { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 6px rgba(0,0,0,0.05); margin-bottom: 30px; }
    label { display: block; margin: 8px 0 4px; }
    select, input, button { width: 100%; padding: 8px; margin-bottom: 14px; border: 1px solid #ccc; border-radius: 4px; }
    button { background-color: #4CAF50; color: white; font-weight: bold; cursor: pointer; }
    button:hover { background-color: #45a049; }
    table { border-collapse: collapse; width: 100%; }
    th, td { text-align: left; padding: 12px; border-bottom: 1px solid #ddd; }
    th { background-color: #f0f0f0; }
</style>

<h2>📋 Enroll a Student</h2>
<form method="POST">
    <label for="student_id">Student ID</label>
    <input type="number" id="student_id" name="student_id" required>

    <label for="course_title">Select Course</label>
    <select id="course_title" name="course_title" required>
        <?php
        $courses = $conn->query("SELECT course_title FROM courses");
        while ($row = $courses->fetch_assoc()) {
            echo "<option value='{$row['course_title']}'>{$row['course_title']}</option>";
        }
        ?>
    </select>

    <button type="submit" name="enroll">Enroll</button>
</form>

<h2>👥 Current Enrollments</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Student ID</th>
        <th>Course Title</th>
    </tr>
    <?php
    $query = "SELECT e.id, e.student_id, c.course_title 
              FROM enrollments e 
              INNER JOIN courses c ON e.course_id = c.course_id";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['student_id']}</td>
                <td>{$row['course_title']}</td>
              </tr>";
    }
    ?>
</table>
