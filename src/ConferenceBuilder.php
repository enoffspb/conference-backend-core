<?php

namespace phprealkit\conference;

use phprealkit\conference\Interfaces\ConferenceBuilderInterface;
use phprealkit\conference\Entity\Conference;

class ConferenceBuilder implements ConferenceBuilderInterface
{
    private Conference $conference;

    public function __construct()
    {
        $this->conference = new Conference();
    }

    public function setName(?string $name): void
    {
        $this->conference->setName($name);
    }

    public function setCode(?string $code): void
    {
        $this->conference->setCode($code);
    }

    public function addParticipant(int $userId, string $role = 'user'): void
    {
        // TODO: Implement addParticipant() method.
    }

    public function setExtraFields(array $extraFields = []): void
    {
        // TODO: Implement setExtraField() method.
    }

    public function getConference(): Conference
    {
        return $this->conference;
    }
}
