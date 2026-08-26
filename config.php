<?php
// Change these values if your MySQL username or password is different.
$host = 'localhost';
$database = 'student_crud_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$database;charset=utf8mb4",
        $username,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    exit('Database connection failed: ' . $error->getMessage());
}
?>
