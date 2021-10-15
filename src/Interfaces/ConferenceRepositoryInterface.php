<?php

namespace phprealkit\conference\Interfaces;

interface ConferenceRepositoryInterface
{
    public function getById(int $id): ?ConferenceInterface;

    /**
     * @return ConferenceInterface[]
     */
    public function getList(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null): array;
}
