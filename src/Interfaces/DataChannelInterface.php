<?php

namespace EnoffSpb\Conference\Interfaces;

/**
 * The interface is used to send a real-time data to web clients from php backend.
 *
 * Example of usage:
 * $dataChannel->send(['data' => 'customData'], ['user:1']);
 */
interface DataChannelInterface
{
    /**
     * @param mixed $data
     * @param string|string[] $channels
     */
    public function send($data, array $channels): void;
}
