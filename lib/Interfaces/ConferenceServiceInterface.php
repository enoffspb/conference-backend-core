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
     * @param string|null $code Code of conference. Can be any string, useful for getting conference in future. E.g. "demo", "call-15", "private-HASH" and other.
     * @param string|null $type Type of conference. Can be any string, useful for filtering conferences by their type. E.g. "conference", "translation", "call".
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
}
