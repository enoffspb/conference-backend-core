<?php

namespace phprealkit\conference\tests\unit;

use phprealkit\conference\Entity\Participant;
use phprealkit\conference\Security\AccessDeniedException;
use phprealkit\conference\Security\DefaultAccessManager;
use phprealkit\conference\ConferenceService;
use phprealkit\conference\Entity\Conference;
use phprealkit\conference\Interfaces\ConferenceBuilderInterface;
use phprealkit\conference\Interfaces\ConferenceInterface;
use phprealkit\conference\Interfaces\ConferenceRepositoryInterface;
use phprealkit\conference\interfaces\ConferenceServiceInterface;

use enoffspb\EntityManager\Driver\InMemoryDriver;
use enoffspb\EntityManager\EntityManager;

use phprealkit\conference\tests\UserProvider;
use PHPUnit\Framework\TestCase;

class ConferenceServiceTest extends TestCase
{
    private static ?ConferenceService $conferenceService;

    private static $conferences = [];
    private static $confIds = [];

    public static function setUpBeforeClass(): void
    {
        $inMemoryDriver = new InMemoryDriver();
        $entitiesConfig = [
            Conference::class => [
                'mapping' => [
                    'id' => [
                        'setter' => 'setId',
                        'getter' => 'getId'
                    ],
                    'code' => [
                        'setter' => 'setCode',
                        'getter' => 'getCode'
                    ]
                ]
            ],
            Participant::class => [
                'mapping' => [
                    'id' => [
                        'setter' => 'setId',
                        'getter' => 'getId'
                    ],
                ]
            ]
        ];
        $entityManager = new EntityManager($inMemoryDriver, $entitiesConfig);

        $accessManager = new DefaultAccessManager();

        $userProvider = new UserProvider();

        self::$conferenceService = new ConferenceService();
        self::$conferenceService->setEntityManager($entityManager);
        self::$conferenceService->setAccessManager($accessManager);
        self::$conferenceService->setUserProvider($userProvider);
    }

    public function testCreateService()
    {
        $this->assertInstanceOf(ConferenceServiceInterface::class, self::$conferenceService);
    }

    public function testGetBuilder()
    {
        $builder = self::$conferenceService->getConferenceBuilder();

        $this->assertInstanceOf(ConferenceBuilderInterface::class, $builder);
    }

    public function testCreateConference()
    {
        $builder = self::$conferenceService->getConferenceBuilder();

        $builder->setCode('test1');
        $builder->addParticipant(1, 'user');
        $builder->addParticipant(2, 'user');
        $conf1 = self::$conferenceService->createConference($builder, 1);

        $this->assertInstanceOf(ConferenceInterface::class, $conf1);
        $this->assertNotNull($conf1->getId());

        $builder = self::$conferenceService->getConferenceBuilder();
        $builder->setCode('test2');
        $builder->addParticipant(3, 'user');
        $builder->addParticipant(4, 'user');
        $conf2 = self::$conferenceService->createConference($builder);

        $this->assertInstanceOf(ConferenceInterface::class, $conf2);
        $this->assertNotNull($conf2->getId());

        $this->assertNotSame($conf1, $conf2);
        $this->assertNotEquals($conf1->getId(), $conf2->getId());

        self::$confIds[] = $conf1->getId();
        self::$confIds[] = $conf2->getId();
    }

    public function testGetRepository()
    {
        $repository = self::$conferenceService->getConferenceRepository();
        $this->assertInstanceOf(ConferenceRepositoryInterface::class, $repository);
    }

    /**
     * @depends testCreateConference
     */
    public function testGetConferenceById()
    {
        $confId1 = self::$confIds[0] ?? null;

        $conference = self::$conferenceService->getConferenceById($confId1);
        $this->assertNotNull($conference);
        $this->assertInstanceOf(ConferenceInterface::class, $conference);

        self::$conferences[$conference->getId()] = $conference;
    }

    /**
     * @depends testCreateConference
     */
    public function testGetConferenceByCode()
    {
        $code = 'test2';

        $conference = self::$conferenceService->getConferenceByCode($code);
        $this->assertNotNull($conference);
        $this->assertInstanceOf(ConferenceInterface::class, $conference);

        self::$conferences[$conference->getId()] = $conference;
    }

    /**
     * @depends testCreateConference
     */
    public function testAddUser()
    {
        $confId = self::$confIds[0];
        $actorId = 1;
        $newUserId = 5;

        $res = self::$conferenceService->addUser($confId, $newUserId, 'user', $actorId);
        $this->assertTrue($res);

        $hasNewUser = false;
        $conf = self::$conferenceService->getConferenceById($confId);
        foreach($conf->getParticipants() as $participant) {
            if($participant->getUserId() === $newUserId) {
                $hasNewUser = true;
                break;
            }
        }
        $this->assertTrue($hasNewUser);

        $anotherActorId = 2;
        $newUserId = 6;

        $this->expectException(AccessDeniedException::class);
        self::$conferenceService->addUser($confId, $newUserId, 'user', $anotherActorId);
    }

    /**
     * @depends testCreateConference
     */
    public function testKickUser()
    {
        // @todo Test method ConferenceService->kickUser()

        throw new \Exception('Method ' . __METHOD__ . ' is not implemented.');
    }

    /**
     * @depends testCreateConference
     */
    public function testCloseConference()
    {
        // @todo Test method ConferenceService->closeConference()

        throw new \Exception('Method ' . __METHOD__ . ' is not implemented.');
    }
}
