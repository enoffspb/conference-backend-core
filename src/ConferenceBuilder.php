<?php

namespace EnoffSpb\Conference;

use EnoffSpb\Conference\Entity\Participant;
use EnoffSpb\Conference\Interfaces\ConferenceBuilderInterface;
use EnoffSpb\Conference\Entity\Conference;

/**
 * ConferenceBuilder is using to create a new conference object.
 */
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
        foreach($this->conference->getParticipants() as $participant) {
            if($participant->getUserId() === $userId) {
                return;
            }
        }

        $participant = new Participant();
        $participant->setUserId($userId);
        $participant->setRole($role);

        $this->conference->addParticipant($participant);
    }

    public function setExtraFields(array $extraFields = []): void
    {
        // TODO: Implement setExtraFields() method.
        throw new \Exception('@TODO: Implement setExtraFields() method.');
    }

    public function getConference(): Conference
    {
        return $this->conference;
    }
}
