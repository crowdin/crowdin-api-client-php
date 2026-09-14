<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\ApplicationConsent;
use PHPUnit\Framework\TestCase;

class ApplicationConsentTest extends TestCase
{
    protected $data = [
        'id' => 12,
        'installedBy' => [
            'id' => 1,
            'username' => 'admin',
            'fullName' => 'Admin User',
            'avatarUrl' => '',
        ],
        'identifier' => 'my-app',
        'name' => 'My Application',
        'status' => 'granted',
        'scopes' => ['project', 'tm'],
        'createdAt' => '2026-07-24T10:00:00+00:00',
        'updatedAt' => '2026-07-24T10:00:00+00:00',
    ];

    public function testLoadData(): void
    {
        $consent = new ApplicationConsent($this->data);

        $this->assertEquals(12, $consent->getId());
        $this->assertEquals($this->data['installedBy'], $consent->getInstalledBy());
        $this->assertEquals('my-app', $consent->getIdentifier());
        $this->assertEquals('My Application', $consent->getName());
        $this->assertEquals('granted', $consent->getStatus());
        $this->assertEquals(['project', 'tm'], $consent->getScopes());
        $this->assertEquals($this->data['createdAt'], $consent->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $consent->getUpdatedAt());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $consent = new ApplicationConsent([
            'id' => 12,
            'identifier' => 'my-app',
            'status' => 'denied',
            'scopes' => [],
            'createdAt' => '2026-07-24T10:00:00+00:00',
            'updatedAt' => '2026-07-24T10:00:00+00:00',
        ]);

        $this->assertNull($consent->getInstalledBy());
        $this->assertNull($consent->getName());
    }

    public function testSetData(): void
    {
        $consent = new ApplicationConsent($this->data);
        $consent->setStatus('denied');
        $consent->setScopes(['project']);

        $this->assertEquals('denied', $consent->getStatus());
        $this->assertEquals(['project'], $consent->getScopes());
    }
}
