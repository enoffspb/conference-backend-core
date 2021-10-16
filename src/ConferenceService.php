<?php

namespace EnoffSpb\Conference;

use EnoffSpb\EntityManager\Interfaces\EntityManagerInterface;

use EnoffSpb\Conference\Entity\Participant;
use EnoffSpb\Conference\Interfaces\AccessManagerInterface;
use EnoffSpb\Conference\Interfaces\ConferenceBuilderInterface;
use EnoffSpb\Conference\Interfaces\ConferenceRepositoryInterface;
use EnoffSpb\Conference\Interfaces\ConferenceServiceInterface;
use EnoffSpb\Conference\Interfaces\ConferenceInterface;
use EnoffSpb\Conference\Entity\Conference;
use EnoffSpb\Conference\Interfaces\DataChannelInterface;
use EnoffSpb\Conference\Interfaces\UserProviderInterface;
use EnoffSpb\Conference\Repository\ConferenceRepository;
use EnoffSpb\Conference\Security\AccessDeniedException;

/**
 * A service provides general functions of the conference subsystem.
 *
 * An object of ConferenceService must be configured before use by setting the all of incoming dependencies:
 * ```php
 * $conferenceService->setEntityManager($entityManager)
 * $conferenceService->setDataChannel($dataChannel)
 * $conferenceService->setAccessManager($accessManager)
 * $conferenceService->setUserProvider($userProvider)
 * ```
 */
class ConferenceService implements ConferenceServiceInterface
{
    private EntityManagerInterface $entityManager;
    private AccessManagerInterface $accessManager;
    private DataChannelInterface $dataChannel;
    private UserProviderInterface $userProvider;

    public function setEntityManager(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setAccessManager(AccessManagerInterface $accessManager)
    {
        $this->accessManager = $accessManager;
    }

    public function setDataChannel(DataChannelInterface $dataChannel)
    {
        $this->dataChannel = $dataChannel;
    }

    public function setUserProvider(UserProviderInterface $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    /**
     * @inheritDoc
     */
    public function getConferenceBuilder(): ConferenceBuilderInterface
    {
        $builder = new ConferenceBuilder();

        return $builder;
    }

    private ?ConferenceRepositoryInterface $conferenceRepository = null;
    public function getConferenceRepository(): ConferenceRepositoryInterface
    {
        if($this->conferenceRepository === null) {
            $this->conferenceRepository = new ConferenceRepository($this->entityManager);
        }

        return $this->conferenceRepository;
    }

    /**
     * @inheritDoc
     */
    public function createConference(ConferenceBuilderInterface $conferenceBuilder, int $userId = null): ?ConferenceInterface
    {
        $conference = $conferenceBuilder->getConference();

        $user = null;
        if($userId !== null) {
            $user = $this->userProvider->getUserById($userId);
            if($user === null) {
                throw new \Exception('ConferenceService.UserProvider.getUserById(' . $userId . ') return null, user is not found.');
            }

            if(!$this->accessManager->canCreateConference($user)) {
                throw new AccessDeniedException();
            }

            $conference->setCreatedBy($userId);
        }

        // @todo startTransaction()

        if(!$this->entityManager->save($conference)) {
            throw new \Exception('Cannot save a conference entity.');
        }

        foreach($conference->getParticipants() as $participant) {
            $participant->setConferenceId($conference->getId());
            $this->entityManager->save($participant);
        }

        // @todo commitTransaction()

        // @todo Trigger a create event
        // @todo Send a notify to each participant through the DataChannel

        return $conference;
    }

    /**
     * @inheritDoc
     */
    public function closeConference(int $conferenceId, int $closedBy = null): bool
    {
        // TODO: Implement closeConference() method.
        throw new \Exception('Method ' . __METHOD__ . ' is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function addUser(int $conferenceId, int $userId, string $role = 'user', ?int $actorId = null): bool
    {
        $conference = $this->getConferenceById($conferenceId);
        $user = $this->userProvider->getUserById($userId);

        if($conference === null) {
            throw new \Exception('Conference #' . $conferenceId . ' is not found.');
        }
        if($user === null) {
            throw new \Exception('User #' . $userId . ' is not found.');
        }

        if($actorId !== null) {
            $actor = $this->userProvider->getUserById($actorId);
            if($actor === null) {
                throw new \Exception('User #' . $actorId . ' is not found.');
            }

            if(!$this->accessManager->canAddUserToConference($actor, $conference, $user, $role)) {
                throw new AccessDeniedException();
            }
        }

        $participant = new Participant();
        $participant->setUserId($userId);
        $participant->setRole($role);
        $participant->setConferenceId($conference->getId());
        $conference->addParticipant($participant);

        $this->entityManager->save($participant);

        // @todo Trigger an event
        // @todo Send a notify to a conference channel via the DataChannel

        return true;
    }

    /**
     * @inheritDoc
     */
    public function userJoins(int $conferenceId, int $userId): void
    {
        // TODO: Implement joinUser() method.
        throw new \Exception('Method ' . __METHOD__ . ' is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function userExits(int $conferenceId, int $userId): void
    {
        // TODO: Implement leaveUser() method.
        throw new \Exception('Method ' . __METHOD__ . ' is not implemented.');
    }

    public function disconnectUser(int $conferenceId, int $userId, ?int $disconnectedBy = null): void
    {
        // TODO: Implement disconnectUser() method.
        throw new \Exception('Method ' . __METHOD__ . ' is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function kickUser(int $conferenceId, int $userId, int $kickedBy = null): bool
    {
        // TODO: Implement kickUser() method.
        throw new \Exception('Method ' . __METHOD__ . ' is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function getConferenceById(int $id): ?ConferenceInterface
    {
        return $this->getConferenceRepository()->getById($id);
    }

    /**
     * @inheritDoc
     */
    public function getConferenceByCode(string $code): ?ConferenceInterface
    {
        $entities = $this->getConferenceRepository()->getList([
            'code' => $code
        ], null, 1);

        if(count($entities) === 0) {
            return null;
        }

        return $entities[0];
    }
}
