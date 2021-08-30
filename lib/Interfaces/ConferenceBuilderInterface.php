<?php

namespace phprealkit\conference\Interfaces;

use phprealkit\conference\Entity\Conference;

interface ConferenceBuilderInterface
{
    public function setName(?string $name): void;
    public function setCode(?string $code): void;
    public function addParticipant(int $userId, string $role = 'user'): void;
    public function setExtraField(array $extraFields = []): void;

    public function getConference(): Conference;
}
