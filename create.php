<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$name = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$course = trim($_POST['course'] ?? '');

if ($name === '' || $course === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.php?message=Please enter valid student details.');
    exit;
}

try {
    $statement = $pdo->prepare('INSERT INTO students (full_name, email, course) VALUES (?, ?, ?)');
    $statement->execute([$name, $email, $course]);
    header('Location: index.php?message=Student saved successfully.');
} catch (PDOException $error) {
    header('Location: index.php?message=Could not save the student. The email may already exist.');
}
exit;
?>
