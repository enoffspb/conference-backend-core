<?php

namespace phprealkit\conference\tests;

use phprealkit\conference\ConferenceService;
use phprealkit\conference\interfaces\ConferenceServiceInterface;
use PHPUnit\Framework\TestCase;

class ConferenceServiceTest extends  TestCase
{
    private ?ConferenceServiceInterface $conferenceService;

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
        // @todo Test method ConferenceService->createConference()

        throw new \Exception('Method is not implemented.');
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
