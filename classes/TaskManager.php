<?php

declare(strict_types=1);

require_once __DIR__ . '/Task.php';
require_once __DIR__ . '/Storage/TaskStorageInterface.php';

final class TaskManager
{
    /**
     * @var Task[]
     */
    private array $tasks = [];

    private TaskStorageInterface $storage;

    public function __construct(TaskStorageInterface $storage)
    {
        $this->storage = $storage;
        $this->tasks = $storage->load();
    }

    public function add(Task $task): void
    {
        $this->tasks[] = $task;
        $this->storage->save($this->tasks);
    }

    public function all(): array
    {
        return $this->tasks;
    }

    public function count(): int
    {
        return count($this->tasks);
    }

    public function findById(string $id): ?Task
    {
        foreach ($this->tasks as $task) {
            if ($task->getId() === $id) {
                return $task;
            }
        }

        return null;
    }

    public function remove(string $id): void
    {
        $this->tasks = array_filter(
            $this->tasks,
            fn(Task $task) => $task->getId() !== $id
        );
        $this->tasks = array_values($this->tasks);
        $this->storage->save($this->tasks);
    }
}
