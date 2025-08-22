<?php
include('config.php');

$student_id = null;
$courses = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'];

    $query = "SELECT c.course_title, c.description, c.instructor_id
              FROM enrollments e
              INNER JOIN courses c ON e.course_id = c.course_id
              WHERE e.student_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $courses = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Enrolled Courses</title>
    <style>
        body { font-family: 'Segoe UI'; background: #f4f4f4; margin: 40px; color: #333; }
        h2 { color: #4CAF50; }
        form, table {
            background: #fff; padding: 20px; border-radius: 8px;
            box-shadow: 0 0 6px rgba(0,0,0,0.05); margin-bottom: 30px;
        }
        input, button {
            width: 100%; padding: 10px; margin-top: 10px;
            border: 1px solid #ccc; border-radius: 4px;
        }
        button {
            background-color: #4CAF50; color: white; font-weight: bold;
            cursor: pointer;
        }
        button:hover { background-color: #45a049; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td {
            text-align: left; padding: 12px; border-bottom: 1px solid #ddd;
        }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>

<h2>📘 View My Enrolled Courses</h2>
<form method="POST">
    <label for="student_id">Enter Your Student ID</label>
    <input type="number" name="student_id" id="student_id" required>
    <button type="submit">View Enrollments</button>
</form>

<?php if ($student_id !== null): ?>
    <h2>📚 Enrolled Courses for ID: <?= htmlspecialchars($student_id) ?></h2>
    <table>
        <tr>
            <th>Course Title</th>
            <th>Description</th>
            <th>Instructor ID</th>
        </tr>
        <?php if (count($courses) > 0): ?>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?= htmlspecialchars($course['course_title']) ?></td>
                    <td><?= htmlspecialchars($course['description']) ?></td>
                    <td><?= htmlspecialchars($course['instructor_id']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No enrollments found.</td></tr>
        <?php endif; ?>
    </table>
<?php endif; ?>

</body>
</html>
