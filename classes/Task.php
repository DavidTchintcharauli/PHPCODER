<?php

final class Task implements JsonSerializable {
    private readonly string $id;
    private readonly string $title;

    public function __construct(string $title, ?string $id = null) {
        $this->id = $id ?? uniqid('', true);
        $this->title = $title;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function withTitle(string $newTitle): Task {
        return new Task($newTitle, $this->id);
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }

    public function jsonSerialize(): array {
        return $this->toArray();
    }
}
?>