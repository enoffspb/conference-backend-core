<?php

namespace phprealkit\conference\Entity;

use phprealkit\conference\Interfaces\ConferenceInterface;

class Conference implements ConferenceInterface
{
    private ?int $id = null;
    private ?string $code = null;
    private ?string $name = null;
    private ?int $createdBy = null;

    /**
     * @var Participant[]
     */
    private array $participants = [];

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

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?int $createdBy)
    {
        $this->createdBy = $createdBy;
    }

    public function getParticipants(): array
    {
        return $this->participants;
    }

    public function addParticipant(int $userId, ?string $role = null): void
    {
        /**
         * @todo Check if participant already exists.
         */

        $participant = new Participant();
        $participant->setUserId($userId);

        $confId = $this->getId();
        if($confId !== null) {
            $participant->setConferenceId($confId);
        }

        $this->participants[] = $participant;
    }
}
