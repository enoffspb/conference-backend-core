<?php

namespace phprealkit\conference\tests;

use phprealkit\conference\ConferenceService;
use phprealkit\conference\Interfaces\ConferenceBuilderInterface;
use phprealkit\conference\Interfaces\ConferenceInterface;
use phprealkit\conference\interfaces\ConferenceServiceInterface;
use PHPUnit\Framework\TestCase;

class ConferenceServiceTest extends TestCase
{
    private ?ConferenceServiceInterface $conferenceService;

    private $conferences = [];
    private $confIds = [];

    public function setUp(): void
    {
        $this->conferenceService = new ConferenceService();
    }

    public function testCreateService()
    {
        $this->assertNotNull($this->conferenceService);
    }

    public function testGetBuilder()
    {
        $builder = $this->conferenceService->getConferenceBuilder();
        $this->assertInstanceOf(ConferenceBuilderInterface::class, $builder);
    }

    public function testCreateConference()
    {
        $builder = $this->conferenceService->getConferenceBuilder();
        $builder->setCode('test1');
        $builder->addParticipant(1, 'user');
        $builder->addParticipant(2, 'user');
        $conf1 = $this->conferenceService->createConference($builder);

        $this->assertInstanceOf(ConferenceInterface::class, $conf1);
        $this->assertNotNull($conf1->getId());


        $builder = $this->conferenceService->getConferenceBuilder();
        $builder->setCode('test2');
        $builder->addParticipant(3, 'user');
        $builder->addParticipant(4, 'user');
        $conf2 = $this->conferenceService->createConference($builder);

        $this->assertInstanceOf(ConferenceInterface::class, $conf2);
        $this->assertNotNull($conf2->getId());

        $this->assertNotSame($conf1, $conf2);
        $this->assertNotEquals($conf1->getId(), $conf2->getId());

        $this->confIds[] = $conf1->getId();
        $this->confIds[] = $conf2->getId();
    }

    public function testGetConferenceById()
    {
        $confId1 = $this->confIds[0] ?? null;

        $this->assertNotNull($confId1);

        $conference = $this->conferenceService->getConferenceById($confId1);
        $this->assertNotNull($conference);
        $this->assertInstanceOf(ConferenceInterface::class, $conference);

        $this->conferences[$conference->getId()] = $conference;
    }

    public function testGetConferenceByCode()
    {
        $code = 'test2';

        $conference = $this->conferenceService->getConferenceByCode($code);
        $this->assertNotNull($conference);
        $this->assertInstanceOf(ConferenceInte8rface::class, $conference);

        $this->conferences[$conference->getId()] = $conference;
    }

    public function testAddUser()
    {
        // @todo Test method ConferenceService->addUser()

        throw new \Exception('Method is not implemented.');
    }

    public function testKickUser()
    {
        // @todo Test method ConferenceService->kickUser()

        throw new \Exception('Method is not implemented.');
    }

    public function testCloseConference()
    {
        // @todo Test method ConferenceService->closeConference()

        throw new \Exception('Method is not implemented.');
    }
}
