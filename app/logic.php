<?php
declare(strict_types=1);

// ⬇ დაიმპორტე აუცილებელი კლასები
require_once __DIR__ . '/../classes/Task.php';
require_once __DIR__ . '/../classes/Storage/TaskStorageInterface.php';
require_once __DIR__ . '/../classes/Storage/JsonTaskStorage.php';
require_once __DIR__ . '/../classes/TaskManager.php';

// ⬇ შექმენი storage და taskManager ობიექტები
$root = dirname(__DIR__);
$storage = new JsonTaskStorage($root . '/storage/tasks.json');
$taskManager = new TaskManager($storage);

// ⬇ დაამუშავე POST მოთხოვნა
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task_title'])) {
    $taskTitle = trim($_POST['task_title']);

    if ($taskTitle !== '' && mb_strlen($taskTitle) <= 255) {
        $task = new Task($taskTitle);
        $taskManager->add($task);
    }

    // თავიდან ავიცილოთ POST-ის დუბლირება refresh-ზე
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
