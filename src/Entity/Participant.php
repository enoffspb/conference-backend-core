<?php

namespace phprealkit\conference\Entity;

class Participant
{
    private ?int $conferenceId = null;
    private int $userId;
    private string $role = 'role';

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
