<?php

namespace EnoffSpb\Conference\Repository;

use EnoffSpb\EntityManager\Interfaces\EntityManagerInterface;
use EnoffSpb\EntityManager\Interfaces\RepositoryInterface;
use EnoffSpb\Conference\Entity\Conference;
use EnoffSpb\Conference\Interfaces\ConferenceInterface;
use EnoffSpb\Conference\Interfaces\ConferenceRepositoryInterface;

class ConferenceRepository implements ConferenceRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private RepositoryInterface $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Conference::class);
    }

    public function getById(int $id): ?ConferenceInterface
    {
        return $this->getRepository()->getById($id);
    }

    /**
     * @return ConferenceInterface[]
     */
    public function getList(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null): array
    {
        return $this->getRepository()->getList($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @return RepositoryInterface<ConferenceInterface>
     */
    private function getRepository(): RepositoryInterface
    {
        return $this->repository;
    }
}
