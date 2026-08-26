<?php
require 'config.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) { header('Location: index.php?message=Invalid student ID.'); exit; }

$statement = $pdo->prepare('SELECT * FROM students WHERE id = ?');
$statement->execute([$id]);
$student = $statement->fetch(PDO::FETCH_ASSOC);
if (!$student) { header('Location: index.php?message=Student not found.'); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Edit Student</title><link rel="stylesheet" href="style.css"></head>
<body>
<main class="container small-container">
    <h1>Edit Student</h1>
    <section class="card">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $student['id'] ?>">
            <label for="full_name">Full name</label>
            <input id="full_name" name="full_name" value="<?= htmlspecialchars($student['full_name']) ?>" required>
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" value="<?= htmlspecialchars($student['email']) ?>" required>
            <label for="course">Course</label>
            <input id="course" name="course" value="<?= htmlspecialchars($student['course']) ?>" required>
            <button type="submit">Update Student</button>
            <a class="back" href="index.php">Cancel</a>
        </form>
    </section>
</main>
</body>
</html>
