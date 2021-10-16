<?php

namespace EnoffSpb\Conference\Security;

use EnoffSpb\Conference\Interfaces\AccessManagerInterface;
use EnoffSpb\Conference\Interfaces\ConferenceInterface;
use EnoffSpb\Conference\Interfaces\UserInterface;
use EnoffSpb\Conference\tests\User;

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

    public function canAddUserToConference(UserInterface $user, ConferenceInterface $conference, UserInterface $newUser, string $role): bool
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
