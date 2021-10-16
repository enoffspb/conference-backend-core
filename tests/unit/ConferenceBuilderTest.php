<?php

namespace EnoffSpb\Conference\tests\unit;

use EnoffSpb\Conference\ConferenceBuilder;
use EnoffSpb\Conference\Entity\Conference;
use PHPUnit\Framework\TestCase;

class ConferenceBuilderTest extends TestCase
{
    private ConferenceBuilder $conferenceBuilder;

    public function setUp(): void
    {
        $this->conferenceBuilder = new ConferenceBuilder();
    }

    public function testFields()
    {
        $confName = 'Test conference';
        $confCode = 'test-conference';

        $this->conferenceBuilder->setCode($confCode);
        $this->conferenceBuilder->setName($confName);

        $conference = $this->conferenceBuilder->getConference();
        $this->assertInstanceOf(Conference::class, $conference);

        $this->assertEquals($confName, $conference->getName());
        $this->assertEquals($confCode, $conference->getCode());

        $this->assertNull($conference->getId());
    }
}
