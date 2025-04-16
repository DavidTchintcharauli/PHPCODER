<?php
declare(strict_types=1);

require_once __DIR__ . '/../classes/Task.php';
require_once __DIR__ . '/../classes/Storage/TaskStorageInterface.php';
require_once __DIR__ . '/../classes/Storage/JsonTaskStorage.php';
require_once __DIR__ . '/../classes/TaskManager.php';

$root = dirname(__DIR__);
$storage = new JsonTaskStorage($root . '/storage/tasks.json');
$taskManager = new TaskManager($storage);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $taskId = trim($_GET['delete']);

    if ($taskManager->findById($taskId) !== null) {
        $taskManager->remove($taskId);
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task_title'])) {
    $taskTitle = trim($_POST['task_title']);

    if ($taskTitle !== '' && mb_strlen($taskTitle) <= 255) {
        $task = new Task($taskTitle);
        $taskManager->add($task);
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
