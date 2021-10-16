<?php

namespace EnoffSpb\Conference\tests;

use EnoffSpb\Conference\Interfaces\UserInterface;

class User implements UserInterface
{
    private int $id;
    private string $name;
    private array $fields = [];

    public function __construct($fields)
    {
        foreach($fields as $k => $v) {
            $this->$k = $v;
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFields(): ?array
    {
        return $this->fields;
    }
}
