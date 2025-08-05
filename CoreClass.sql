
CREATE DATABASE IF NOT EXISTS coreclass_db;
USE coreclass_db;


CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role ENUM('student', 'instructor', 'admin') NOT NULL
);


CREATE TABLE courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_title VARCHAR(255) NOT NULL UNIQUE
);


CREATE TABLE materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    material_title VARCHAR(255),
    file_path VARCHAR(255)
);


CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT,
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
);
