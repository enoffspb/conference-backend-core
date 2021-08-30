<?php

namespace phprealkit\conference\Interfaces;

/**
 * Interface ConferenceServiceInterface
 * @package phprealkit\conference\Interfaces
 *
 * Provides general functions of Conference module.
 */
interface ConferenceServiceInterface
{
    /**
     * Returns new instance of ConferenceBuilder
     */
    public function getConferenceBuilder(): ?ConferenceBuilderInterface;

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
     * Closes a conference. The conference unavailable to join after closing.
     *
     * @param int $conferenceId ID of a conference
     * @param int|null $closedBy ID of a user that close conference, null for close by the system.
     * @return bool
     */
    public function closeConference(int $conferenceId, int $closedBy = null): bool;

    /**
     * Add user to a conference.
     *
     * @param int $conferenceId ID of a conference
     * @param int $userId ID of a user
     * @param string $role Role of a user. Can be any string, e.g. "user", "client", "operator", "admin"
     * @return bool
     */
    public function addUser(int $conferenceId, int $userId, string $role = 'user'): bool;

    /**
     * Join user to a conference. Note that method doesn't "join" user, only save an information about join.
     *
     * @param int $conferenceId ID of a conference
     * @param int $userId ID of a user
     */
    public function joinUser(int $conferenceId, int $userId): void;

    /**
     * Leave user from a conference. Note that method doesn't "leave" user, only save an information about leave.
     *
     * @param int $conferenceId ID of a conference
     * @param int $userId ID of a user
     */
    public function leaveUser(int $conferenceId, int $userId): void;

    /**
     * Kick user from a conference.
     *
     * @param int $conferenceId ID of a conference
     * @param int $userId ID of a user
     * @param int|null $kickedBy ID of a user that kicks
     * @return bool
     */
    public function kickUser(int $conferenceId, int $userId, int $kickedBy = null): bool;

    /**
     * Get a conference by ID
     *
     * @param int $id ID of conference
     * @return ConferenceInterface|null
     */
    public function getConferenceById(int $id): ?ConferenceInterface;

    /**
     * Get a conference by code
     *
     * @param string $code
     * @return ConferenceInterface|null
     */
    public function getConferenceByCode(string $code): ?ConferenceInterface;
}
