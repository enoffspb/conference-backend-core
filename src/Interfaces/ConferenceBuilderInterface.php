<?php

namespace EnoffSpb\Conference\Interfaces;

use EnoffSpb\Conference\Entity\Conference;

/**
 * An interface for ConferenceBuilder is using to create a new conference object.
 */
interface ConferenceBuilderInterface
{
    public function setName(?string $name): void;
    public function setCode(?string $code): void;
    public function addParticipant(int $userId, string $role = 'user'): void;
    public function setExtraFields(array $extraFields = []): void;

    public function getConference(): Conference;
}
