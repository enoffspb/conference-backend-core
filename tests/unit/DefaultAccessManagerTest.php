<?php

namespace phprealkit\conference\tests\unit;

use phprealkit\conference\Access\DefaultAccessManager;
use phprealkit\conference\Entity\Conference;
use phprealkit\conference\Interfaces\AccessManagerInterface;
use PHPUnit\Framework\TestCase;

use phprealkit\conference\tests\User;

class DefaultAccessManagerTest extends TestCase
{
    private static AccessManagerInterface $accessManager;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$accessManager = new DefaultAccessManager();
    }

    public function getAccessManager(): ?AccessManagerInterface
    {
        return self::$accessManager;
    }

    public function testCanCreateConference()
    {
        $accessManager = $this->getAccessManager();

        $user = new User([
            'id' => 1,
            'name' => 'User 1'
        ]);

        $this->assertTrue($accessManager->canCreateConference($user));
    }

    public function testCanCloseConference()
    {
        $accessManager = $this->getAccessManager();

        $creator = new User([
            'id' => 1,
            'name' => 'Creator'
        ]);
        $user2 = new User([
            'id' => 2,
            'name' => 'User 2'
        ]);

        $conference = new Conference();
        $conference->setCreatedBy(1);

        $this->assertTrue($accessManager->canCloseConference($creator, $conference));
        $this->assertFalse($accessManager->canCloseConference($user2, $conference));
    }

    public function testCanUserJoinToConference()
    {
        $accessManager = $this->getAccessManager();

        $creator = new User([
            'id' => 1,
            'name' => 'Creator'
        ]);
        $user2 = new User([
            'id' => 2,
            'name' => 'User 2'
        ]);
        $notParticipant = new User([
            'id' => 3,
            'name' => 'Not participant'
        ]);

        $conference = new Conference();
        $conference->setCreatedBy(1);

        $conference->addParticipant(1, 'host');
        $conference->addParticipant(2, 'user');

        $this->assertTrue($accessManager->canUserJoinToConference($creator, $conference));
        $this->assertTrue($accessManager->canUserJoinToConference($user2, $conference));
        $this->assertFalse($accessManager->canUserJoinToConference($notParticipant, $conference));
    }
}
