<?php

namespace phprealkit\conference;

use phprealkit\conference\Interfaces\ConferenceBuilderInterface;
use phprealkit\conference\Interfaces\ConferenceServiceInterface;
use phprealkit\conference\Interfaces\ConferenceInterface;
use phprealkit\conference\Entity\Conference;

class ConferenceService implements ConferenceServiceInterface
{
    /**
     * @inheritDoc
     */
    public function getConferenceBuilder(): ConferenceBuilderInterface
    {
        $builder = new ConferenceBuilder();

        return $builder;
    }

    /**
     * @inheritDoc
     */
    public function createConference(ConferenceBuilderInterface $conferenceBuilder): ?ConferenceInterface
    {
        $conference = $conferenceBuilder->getConference();

        throw new \Exception('@TODO Save conference');

        return $conference;
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

    /**
     * @inheritDoc
     */
    public function getConferenceById(int $id): ?ConferenceInterface
    {
        // TODO: Implement getConferenceById() method.
        throw new \Exception('Method is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function getConferenceByCode(string $code): ?ConferenceInterface
    {
        // TODO: Implement getConferenceByCode() method.
        throw new \Exception('Method is not implemented.');
    }
}
