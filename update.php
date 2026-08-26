<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); exit; }

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$name = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$course = trim($_POST['course'] ?? '');

if (!$id || $name === '' || $course === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.php?message=Please enter valid student details.'); exit;
}

try {
    $statement = $pdo->prepare('UPDATE students SET full_name = ?, email = ?, course = ? WHERE id = ?');
    $statement->execute([$name, $email, $course, $id]);
    header('Location: index.php?message=Student updated successfully.');
} catch (PDOException $error) {
    header('Location: index.php?message=Could not update the student. The email may already exist.');
}
exit;
?>
