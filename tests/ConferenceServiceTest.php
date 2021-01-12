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
}
