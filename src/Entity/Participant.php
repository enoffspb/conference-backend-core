<?php

namespace phprealkit\conference\Entity;

use phpDocumentor\Reflection\Types\Null_;

class Participant
{
    private ?int $id = null;
    private ?int $conferenceId = null;
    private int $userId;
    private string $role = 'role';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getConferenceId(): ?int
    {
        return $this->conferenceId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setConferenceId(int $conferenceId): void
    {
        $this->conferenceId = $conferenceId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setRole(?string $role): void
    {
        $this->role = $role;
    }
}
