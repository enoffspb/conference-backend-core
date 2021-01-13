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
     * Create a conference with given code, type, users and settings.
     *
     * @param string|null $code Code of a conference. Can be any string, useful for getting the conference in future. E.g. "demo", "call-15", "private-HASH" and other.
     * @param string|null $type Type of a conference. Can be any string, useful for filtering conferences by their type. E.g. "conference", "translation", "call".
     * @param array $users List of users in next format: [$id => $role, ...], e.g.: [1 => 'operator', 2 => 'client'] or [3 => 'user', 4 => 'user']
     * @param array|null $settings Any predefined and custom settings. ['mode' => 'video']  // or 'audio'
     * @return int|null ID of new conference or null, if error was occurred.
     */
    public function createConference(
        ?string $code = null,
        ?string $type = 'conference',
        array $users = [],
        ?array $settings = null
    ): ?int;

    /**
     * Close a conference. The conference unavailable to join after closing.
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
