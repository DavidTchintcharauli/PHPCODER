<?php

declare(strict_types=1);

interface TaskStorageInterface
{
    /**
     * @return Task[]
     */
    public function load(): array;

    public function save(array $tasks): void;
}
