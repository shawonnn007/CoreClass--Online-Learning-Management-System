<?php
include('config.php');

$student_id = null;
$grades = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = intval($_POST['student_id']);

    $query = "SELECT c.course_title, g.grade
              FROM grades g
              INNER JOIN courses c ON g.course_id = c.course_id
              WHERE g.student_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $grades = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Grades</title>
    <style>
        body { font-family: 'Segoe UI'; background: #f7f9fc; padding: 40px; color: #333; }
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

<h2>📘 View My Grades</h2>
<form method="POST">
    <label for="student_id">Enter Your Student ID</label>
    <input type="number" name="student_id" id="student_id" required>
    <button type="submit">Check Grades</button>
</form>

<?php if ($student_id !== null): ?>
    <h2>📊 Grades for Student ID: <?= htmlspecialchars($student_id) ?></h2>
    <table>
        <tr>
            <th>Course Title</th>
            <th>Grade</th>
        </tr>
        <?php if (count($grades) > 0): ?>
            <?php foreach ($grades as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['course_title']) ?></td>
                    <td><?= htmlspecialchars($row['grade']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="2">No grades yet.</td></tr>
        <?php endif; ?>
    </table>
<?php endif; ?>

</body>
</html>