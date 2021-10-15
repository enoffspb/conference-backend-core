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

    public function getUserById(int $id): ?User
    {
        if(isset($this->cache[$id])) {
            return $this->cache[$id];
        }

        $user = $this->createUser($id);

        $this->cache[$id] = $user;

        return $this->cache[$id];
    }

    /**
     * @return User[]
     */
    public function getUsersByIds(array $ids): array
    {
        $result = [];

        foreach($ids as $id) {
            $user = $this->getUserById($id);
            $result[$id] = $user;
        }

        return $user;
    }

    private function createUser(int $id): User
    {
        $user = new User([
            'id' => $id,
            'name' => 'User #' . $id
        ]);
    }
}
