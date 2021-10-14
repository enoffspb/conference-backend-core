<?php

namespace phprealkit\conference\tests;

use phprealkit\conference\Interfaces\UserInterface;
use phprealkit\conference\Interfaces\UserProviderInterface;

/**
 * An implementation of UserProviderInterface for automated tests.
 * It builds and returns a User object with given ID
 */
class UserProvider implements UserProviderInterface
{
    private array $cache = [];

    public function getUserById(int $id): ?UserInterface
    {
        if(isset($this->cache[$id])) {
            return $this->cache[$id];
        }

        $user = new User([
            'id' => $id,
            'name' => 'User #' . $id
        ]);

        $this->cache[$id] = $user;

        return $this->cache[$id];
    }

    public function getUsersByIds(): array
    {
        // TODO: Implement getUsersByIds() method.
    }
}
