<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); exit; }

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if ($id) {
    $statement = $pdo->prepare('DELETE FROM students WHERE id = ?');
    $statement->execute([$id]);
}
header('Location: index.php?message=Student deleted successfully.');
exit;
?>
