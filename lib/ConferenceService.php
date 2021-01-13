<?php

namespace phprealkit\conference;

use phprealkit\conference\Interfaces\ConferenceServiceInterface;

class ConferenceService implements ConferenceServiceInterface
{
    /**
     * @inheritDoc
     */
    public function createConference(?string $code = null, ?string $type = 'conference', array $users = [], ?array $settings = null): ?int
    {
        throw new \Exception('Method is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function closeConference(int $conferenceId, int $closedBy = null): bool
    {
        // TODO: Implement closeConference() method.
        throw new \Exception('Method is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function addUser(int $conferenceId, int $userId, string $role = 'user'): bool
    {
        // TODO: Implement addUser() method.
        throw new \Exception('Method is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function joinUser(int $conferenceId, int $userId): void
    {
        // TODO: Implement joinUser() method.
        throw new \Exception('Method is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function leaveUser(int $conferenceId, int $userId): void
    {
        // TODO: Implement leaveUser() method.
        throw new \Exception('Method is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function kickUser(int $conferenceId, int $userId, int $kickedBy = null): bool
    {
        // TODO: Implement kickUser() method.
        throw new \Exception('Method is not implemented.');
    }
}
