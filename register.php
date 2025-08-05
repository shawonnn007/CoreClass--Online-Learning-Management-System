<?php

include 'config.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $name     = $conn->real_escape_string($_POST['name']);
    $email    = $conn->real_escape_string($_POST['email']);

    $password = $_POST['password'];
    $role     = $conn->real_escape_string($_POST['role']);


    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {

        echo "Registration successful! <a href='login.html'>Click here to log in</a>.";
    } else {

        echo "Error: " . $conn->error;
    }


    $conn->close();
}
?>