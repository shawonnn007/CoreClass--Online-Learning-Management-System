<?php
session_start();
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $instructor_id = 1;


    $sql = "INSERT INTO courses (course_title, description, instructor_id) 
            VALUES ('$course_title', '$description', '$instructor_id')";

    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$courses_sql = "SELECT * FROM courses";
$courses_result = $conn->query($courses_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Courses</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f4f4f4; }
        h2 { color: #333; }
        form, table { margin-top: 20px; background: #fff; padding: 20px; border-radius: 6px; }
        input, textarea { width: 100%; margin-bottom: 10px; padding: 8px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
    </style>
</head>
<body>
    <h2>➕ Add a New Course</h2>
    <form method="POST" action="courses.php">
        <label>Course Title</label><br>
        <input type="text" name="course_title" required><br>
        <label>Description</label><br>
        <textarea name="description" required></textarea><br><br>
        <input type="submit" value="Create Course">
    </form>

    <h2>📚 All Courses</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Instructor ID</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($courses_result && $courses_result->num_rows > 0) {
                while ($row = $courses_result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['course_title']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['instructor_id']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No courses found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>