<?php

namespace phprealkit\conference\Interfaces;

/**
 * Provides general functions of the conference subsystem.
 */
interface ConferenceServiceInterface
{
    /**
     * Returns a new instance of ConferenceBuilder
     */
    public function getConferenceBuilder(): ?ConferenceBuilderInterface;

    /**
     * Returns an instance of ConferenceRepository
     */
    public function getConferenceRepository(): ConferenceRepositoryInterface;

    /**
     * Creates a new conference.
     *
     * @param ConferenceBuilderInterface $conferenceBuilder Instance of ConferenceBuilder
     * @return ConferenceInterface|null New conference object or null, if error has occurred.
     */
    public function createConference(
        ConferenceBuilderInterface $conferenceBuilder
    ): ?ConferenceInterface;

    /**
     * Closes a conference. The conference is unavailable to join after closing.
     *
     * @param int $conferenceId ID of a conference
     * @param int|null $closedBy ID of a user who closes conference, otherwise null if the system is an actor.
     * @return bool
     */
    public function closeConference(int $conferenceId, int $closedBy = null): bool;

    /**
     * Add a user to a conference.
     *
     * @param int $conferenceId ID of a conference
     * @param int $userId ID of a user
     * @param string $role Role of a user. Can be any string, e.g. "user", "client", "operator", "admin"
     * @return bool
     */
    public function addUser(int $conferenceId, int $userId, string $role = 'user'): bool;

    /**
     * Kicks user from a conference.
     *
     * @param int $conferenceId ID of a conference
     * @param int $userId ID of a user
     * @param int|null $kickedBy ID of a user that kicks
     * @return bool
     */
    public function kickUser(int $conferenceId, int $userId, int $kickedBy = null): bool;

    /**
     * A user joins to a conference.
     *
     * @param int $conferenceId ID of a conference
     * @param int $userId ID of a user
     */
    public function userJoins(int $conferenceId, int $userId): void;

    /**
     * A user exits from a conference.
     *
     * @param int $conferenceId ID of a conference
     * @param int $userId ID of a user
     */
    public function userExits(int $conferenceId, int $userId): void;

    /**
     * Disconnect a user from a conference (just for current connection). The user can join again.
     *
     * @param int $conferenceId ID of a conference
     * @param int $userId ID of a user
     * @param int|null $disconnectedBy ID of a user who is doing disconnect
     */
    public function disconnectUser(int $conferenceId, int $userId, ?int $disconnectedBy = null): void;

    /**
     * Gets a conference by ID
     *
     * @param int $id ID of conference
     * @return ConferenceInterface|null
     */
    public function getConferenceById(int $id): ?ConferenceInterface;

    /**
     * Gets a conference by a code
     *
     * @param string $code
     * @return ConferenceInterface|null
     */
    public function getConferenceByCode(string $code): ?ConferenceInterface;
}
