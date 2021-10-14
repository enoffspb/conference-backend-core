<?php

namespace phprealkit\conference;

use enoffspb\EntityManager\Interfaces\EntityManagerInterface;

use phprealkit\conference\Interfaces\AccessManagerInterface;
use phprealkit\conference\Interfaces\ConferenceBuilderInterface;
use phprealkit\conference\Interfaces\ConferenceServiceInterface;
use phprealkit\conference\Interfaces\ConferenceInterface;
use phprealkit\conference\Entity\Conference;
use phprealkit\conference\Interfaces\DataChannelInterface;
use phprealkit\conference\Interfaces\UserProviderInterface;

/**
 * A service provides general functions of the conference subsystem.
 *
 * An object of ConferenceService must be configured before use by setting all of incoming dependencies:
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
                // @todo add a error to the service
                return null;
            }
        }

        if(!$this->entityManager->save($conference)) {
            throw new \Exception('Cannot save conference entity.');
        }

        return $conference;
    }

    /**
     * @inheritDoc
     */
    public function closeConference(int $conferenceId, int $closedBy = null): bool
    {
        // TODO: Implement closeConference() method.
        throw new \Exception('Method is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function addUser(int $conferenceId, int $userId, string $role = 'user'): bool
    {
        // TODO: Implement addUser() method.
        throw new \Exception('Method is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function userJoins(int $conferenceId, int $userId): void
    {
        // TODO: Implement joinUser() method.
        throw new \Exception('Method is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function userExits(int $conferenceId, int $userId): void
    {
        // TODO: Implement leaveUser() method.
        throw new \Exception('Method is not implemented.');
    }

    public function disconnectUser(int $conferenceId, int $userId, ?int $disconnectedBy = null): void
    {
        // TODO: Implement disconnectUser() method.
        throw new \Exception('Method is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function kickUser(int $conferenceId, int $userId, int $kickedBy = null): bool
    {
        // TODO: Implement kickUser() method.
        throw new \Exception('Method is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function getConferenceById(int $id): ?ConferenceInterface
    {
        // TODO: Implement getConferenceById() method.
        throw new \Exception('Method is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function getConferenceByCode(string $code): ?ConferenceInterface
    {
        // TODO: Implement getConferenceByCode() method.
        throw new \Exception('Method is not implemented.');
    }
}
