<?php
include('config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Quiz Submissions</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f4f8; padding: 20px; color: #333; }
        h2 { color: #4CAF50; }
        table {
            width: 100%; border-collapse: collapse; margin-top: 20px;
            background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px; border-bottom: 1px solid #ddd; text-align: left;
        }
        th { background-color: #f0f0f0; }
        a.download {
            color: #4a90e2; text-decoration: none; font-weight: bold;
        }
        a.download:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>📄 Student Quiz Submissions</h2>
<table>
    <tr>
        <th>Submission ID</th>
        <th>Student ID</th>
        <th>Quiz Title</th>
        <th>Submitted At</th>
        <th>Answer PDF</th>
    </tr>
    <?php
    $query = "SELECT s.submission_id, s.student_id, q.title, s.submitted_at, s.file_path
              FROM quiz_submissions s
              INNER JOIN quizzes q ON s.quiz_id = q.quiz_id
              ORDER BY s.submitted_at DESC";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['submission_id']}</td>
                    <td>{$row['student_id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['submitted_at']}</td>
                    <td><a class='download' href='{$row['file_path']}' target='_blank'>Download PDF</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No submissions found.</td></tr>";
    }
    ?>
</table>

</body>
</html>