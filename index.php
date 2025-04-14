<?php
require_once __DIR__ . '/app/logic.php';
?>

<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>Todo</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>ჩემი დავალებები (<?= $taskManager->count(); ?>)</h1>

        <form method="POST" autocomplete="off">
            <input type="text" name="task_title" placeholder="შეიყვანე დავალება" required>
            <button type="submit">დამატება</button>
        </form>

        <ul>
            <?php foreach ($taskManager->all() as $task): ?>
                <li><?= htmlspecialchars($task->getTitle(), ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
