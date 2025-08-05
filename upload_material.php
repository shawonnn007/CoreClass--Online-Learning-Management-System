<?php
session_start();
include 'config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseId = $_POST['course_id'];
    $title = $_POST['material_title'];
    $file = $_FILES['material_file'];

    if ($file['error'] === 0) {
        $targetDir = 'uploads/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = basename($file['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            $stmt = $conn->prepare("INSERT INTO materials (course_id, material_title, file_path) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $courseId, $title, $targetFile);
            $stmt->execute();
            echo "<p>Material uploaded successfully!</p>";
        } else {
            echo "<p>File upload failed.</p>";
        }
    } else {
        echo "<p>Error during file upload: " . $file['error'] . "</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Material</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .upload-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }
        .upload-box h2 {
            margin-bottom: 20px;
            font-size: 1.4em;
            color: #333;
            text-align: center;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: 500;
        }
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        button {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            background-color: #0078D7;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
        }
        button:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>
    <div class="upload-box">
        <h2>Upload Course Material</h2>
        <form action="upload_material.php" method="POST" enctype="multipart/form-data">
            <label for="course_id">Course ID</label>
            <input type="text" name="course_id" required>

            <label for="material_title">Material Title</label>
            <input type="text" name="material_title" required>

            <label for="material_file">File</label>
            <input type="file" name="material_file" required>

            <button type="submit">Upload</button>
        </form>
    </div>
</body>
</html>