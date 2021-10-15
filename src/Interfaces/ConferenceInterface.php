<?php

namespace phprealkit\conference\Interfaces;

use phprealkit\conference\Entity\Participant;

/**
 * An interface for Conference model.
 */
interface ConferenceInterface
{
    public function getId(): ?int;
    public function getCode(): ?string;
    public function getName(): ?string;
    public function getCreatedBy(): ?int;

    /**
     * @return Participant[]
     */
    public function getParticipants(): array;

    public function addParticipant(Participant $participant): void;
}
