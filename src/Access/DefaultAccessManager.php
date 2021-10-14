<?php

namespace phprealkit\conference\Access;

use phprealkit\conference\Interfaces\AccessManagerInterface;
use phprealkit\conference\Interfaces\ConferenceInterface;
use phprealkit\conference\Interfaces\UserInterface;

class DefaultAccessManager implements AccessManagerInterface
{

    public function canCreateConference(UserInterface $user): bool
    {
        return true;
    }

    public function canCloseConference(UserInterface $user, ConferenceInterface $conference): bool
    {
        if($conference->getCreatedBy() === $user->getId()) {
            return true;
        }

        return false;
    }

    public function canAddUserToConference(UserInterface $user, ConferenceInterface $conference): bool
    {
        if($conference->getCreatedBy() === $user->getId()) {
            return true;
        }

        return false;
    }

    public function canUserJoinToConference(UserInterface $user, ConferenceInterface $conference): bool
    {
        $userId = $user->getId();

        foreach($conference->getParticipants() as $participant)
        {
            if($participant->getUserId() === $userId) {
                return true;
            }
        }

        return false;
    }
}
