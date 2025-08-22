<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Dashboard</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f0f4f8; margin:0; padding:0;
      display:flex; flex-direction:column; align-items:center; }
    header { width:100%; padding:20px; background:#fff; box-shadow:0 1px 3px rgba(0,0,0,0.1);
      text-align:center; }
    header h1 { margin:0; color:#333; }
    nav { margin-top:40px; }
    nav a { display:block; width:240px; padding:15px; margin-bottom:12px;
      background:#fff; color:#4a90e2; text-align:center; text-decoration:none;
      border-radius:6px; box-shadow:0 1px 3px rgba(0,0,0,0.1); }
    nav a:hover { background:#e6f2fc; }
  </style>
</head>
<body>

  <header>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?></h1>
  </header>

  <nav>
    <a href="enrollment_module.php">Enroll in a Course</a>
    <a href="studentenroll_view.php">My Enrollments</a>
    <a href="submit_quiz.php">Submit Quiz Answer</a>
    <a href="view_grades.php">View My Grades</a>
    <a href="forum_student.php">Course Discussions</a>
    <a href="logout.php">Log Out</a>
  </nav>

</body>
</html>
