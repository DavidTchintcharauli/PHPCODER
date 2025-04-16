<?php require_once __DIR__ . '/app/logic.php'; ?>

<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>Todo</title>
    <link rel="stylesheet" href="styles.css">
    <script src="./index.js" defer></script>
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
                <li>
                    <span><?= htmlspecialchars($task->getTitle(), ENT_QUOTES, 'UTF-8') ?></span>
                    <a href="?delete=<?= urlencode($task->getId()) ?>"
                       class="delete-link"
                       onclick="event.preventDefault(); confirmModal('ნამდვილად გსურს ამ დავალების წაშლა?', () => window.location.href=this.href);">
                       ✕
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div id="modal" class="modal hidden">
        <div class="modal-content">
            <p id="modal-message">ნამდვილად გსურს?</p>
            <div class="modal-actions">
                <button id="modal-confirm">დიახ</button>
                <button id="modal-cancel">არა</button>
            </div>
        </div>
    </div>
</body>
</html>
