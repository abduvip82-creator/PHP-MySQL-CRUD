<?php
require 'config.php';
$students = $pdo->query('SELECT * FROM students ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
$message = $_GET['message'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <h1>Student Records</h1>
        <p class="intro">Add a student record, then view, edit, or delete it below.</p>

        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <section class="card">
            <h2>Add Student</h2>
            <form action="create.php" method="POST">
                <label for="full_name">Full name</label>
                <input id="full_name" name="full_name" type="text" required>

                <label for="email">Email address</label>
                <input id="email" name="email" type="email" required>

                <label for="course">Course</label>
                <input id="course" name="course" type="text" required>

                <button type="submit">Save Student</button>
            </form>
        </section>

        <section class="card">
            <h2>Saved Students</h2>
            <?php if (!$students): ?>
                <p>No student records yet.</p>
            <?php else: ?>
                <div class="table-wrap">
                    <table>
                        <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Actions</th></tr></thead>
                        <tbody>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= $student['id'] ?></td>
                                <td><?= htmlspecialchars($student['full_name']) ?></td>
                                <td><?= htmlspecialchars($student['email']) ?></td>
                                <td><?= htmlspecialchars($student['course']) ?></td>
                                <td class="actions">
                                    <a class="edit" href="edit.php?id=<?= $student['id'] ?>">Edit</a>
                                    <form action="delete.php" method="POST" onsubmit="return confirm('Delete this student?');">
                                        <input type="hidden" name="id" value="<?= $student['id'] ?>">
                                        <button class="delete" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
