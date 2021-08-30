<?php

namespace phprealkit\conference\tests;

use phprealkit\conference\ConferenceService;
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

    public function testCreateConference()
    {
        $confId1 = $this->conferenceService->createConference('test1', 'conference', [
            1 => 'user',
            2 => 'user'
        ]);
        $this->assertNotNull($confId1);

        $confId2 = $this->conferenceService->createConference('test2', 'conference', [
            3 => 'user',
            4 => 'user'
        ]);
        $this->assertNotNull($confId2);

        $this->assertNotSame($confId1, $confId2);

        $this->confIds[] = $confId1;
        $this->confIds[] = $confId2;
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
