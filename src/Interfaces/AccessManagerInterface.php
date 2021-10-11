<?php

namespace phprealkit\conference\Interfaces;

/**
 * An interface for AccessManager is using to check user's rights to execute actions.
 */
interface AccessManagerInterface
{
    public function canCreateConference(UserInterface $user): bool;
    public function canCloseConference(UserInterface $user, ConferenceInterface $conference): bool;
    public function canAddUserToConference(UserInterface $user, ConferenceInterface $conference): bool;
    public function canUserJoinToConference(UserInterface $user, ConferenceInterface $conference): bool;
}
