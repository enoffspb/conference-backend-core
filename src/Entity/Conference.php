<?php

namespace phprealkit\conference\Entity;

use phprealkit\conference\Interfaces\ConferenceInterface;

class Conference implements ConferenceInterface
{
    private ?int $id = null;
    private ?string $code = null;
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code)
    {
        $this->code = $code;
    }

    public function setName(?string $name)
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
