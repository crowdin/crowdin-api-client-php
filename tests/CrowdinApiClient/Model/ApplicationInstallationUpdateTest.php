<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\ApplicationInstallationUpdate;
use PHPUnit\Framework\TestCase;

class ApplicationInstallationUpdateTest extends TestCase
{
    public function testLoadData(): void
    {
        $update = new ApplicationInstallationUpdate([
            'manifestHash' => 'a1b2c3',
            'latestManifest' => ['identifier' => 'my-app'],
            'addedScopes' => ['tm'],
            'removedScopes' => ['glossary'],
            'addedModules' => [['key' => 'new-module']],
            'removedModules' => [['key' => 'old-module']],
            'changedModules' => [['key' => 'module-1']],
            'changedEvents' => ['installed' => ['from' => '/old', 'to' => '/new']],
            'baseUrlChanged' => ['from' => 'https://a.dev', 'to' => 'https://b.dev'],
            'authenticationTypeChanged' => ['from' => 'none', 'to' => 'crowdin_app'],
            'hasChanges' => true,
        ]);

        $this->assertSame('a1b2c3', $update->getManifestHash());
        $this->assertSame(['identifier' => 'my-app'], $update->getLatestManifest());
        $this->assertSame(['tm'], $update->getAddedScopes());
        $this->assertSame(['glossary'], $update->getRemovedScopes());
        $this->assertSame([['key' => 'new-module']], $update->getAddedModules());
        $this->assertSame([['key' => 'old-module']], $update->getRemovedModules());
        $this->assertSame([['key' => 'module-1']], $update->getChangedModules());
        $this->assertSame(['installed' => ['from' => '/old', 'to' => '/new']], $update->getChangedEvents());
        $this->assertSame(['from' => 'https://a.dev', 'to' => 'https://b.dev'], $update->getBaseUrlChanged());
        $this->assertSame(['from' => 'none', 'to' => 'crowdin_app'], $update->getAuthenticationTypeChanged());
        $this->assertTrue($update->hasChanges());
    }

    public function testLoadDataWithoutChanges(): void
    {
        $update = new ApplicationInstallationUpdate(['hasChanges' => false]);

        $this->assertNull($update->getManifestHash());
        $this->assertNull($update->getLatestManifest());
        $this->assertSame([], $update->getAddedScopes());
        $this->assertFalse($update->hasChanges());
    }
}
