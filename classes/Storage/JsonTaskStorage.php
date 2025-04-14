<?php

declare(strict_types=1);

require_once __DIR__ . '/../Task.php';
require_once __DIR__ . '/TaskStorageInterface.php';

final class JsonTaskStorage implements TaskStorageInterface
{
    private string $file;

    public function __construct(string $filePath)
    {
        $this->file = $filePath;
        if (!file_exists($filePath)) {
            file_put_contents($filePath, '[]');
        }
    }

    public function load(): array
    {
        $json = file_get_contents($this->file);
        $data = json_decode($json, true);
    
        if (!is_array($data)) {
            $data = [];
        }
    
        $tasks = [];
    
        foreach ($data as $item) {
            if (isset($item['title'], $item['id'])) {
                $tasks[] = new Task($item['title'], $item['id']);
            }
        }
    
        return $tasks;
    }

    public function save(array $tasks): void
    {
        $data = array_map(fn(Task $task) => $task->toArray(), $tasks);
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }
}
