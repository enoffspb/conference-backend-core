<?php

namespace phprealkit\conference\Interfaces;

/**
 * An implementation of that interface must be provide users from a target system.
 */
interface UserProviderInterface
{
    public function getUserById(int $id): ?UserInterface;

    /**
     * @param int[] $ids
     * @return UserInterface[]
     */
    public function getUsersByIds(array $ids): array;
}
