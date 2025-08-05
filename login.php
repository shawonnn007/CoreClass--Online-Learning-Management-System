<?php
session_start();          
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql    = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {

            $_SESSION['user_id']  = $user['id'];
            $_SESSION['user_name']= $user['name'];
            $_SESSION['role']     = $user['role'];

      
            switch ($user['role']) {
                case 'student':
                    header("Location: dashboard_student.php");
                    exit;
                case 'instructor':
                    header("Location: dashboard_instructor.html");
                    exit;
                case 'admin':
                    header("Location: dashboard_admin.html");
                    exit;
            }
        } else {
            echo "Incorrect password. <a href='login.html'>Try again</a>.";
        }
    } else {
        echo "No account found. <a href='register.html'>Register here</a>.";
    }
    $conn->close();
}
