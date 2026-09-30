<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\Organization;
use PHPUnit\Framework\TestCase;

class OrganizationTest extends TestCase
{
    public function testLoadData(): void
    {
        $organization = new Organization([
            'id' => 200000999,
            'domain' => 'acme',
            'name' => 'Acme',
            'logo' => 'https://acme.dev/logo.png',
            'defaultLogo' => 'https://crowdin.com/logo.png',
            'description' => 'Public description',
            'internalDescription' => 'Internal notes',
            'cname' => 'l10n.acme.dev',
            'isVendor' => true,
            'defaultPublicProjectsView' => 'list',
            'plan' => ['name' => 'Business', 'wordsLimit' => 100000, 'managersLimit' => 10],
            'defaults' => [['name' => 'projectVisibility', 'isLocked' => true, 'defaultValue' => 'private']],
        ]);

        $this->assertSame(200000999, $organization->getId());
        $this->assertSame('acme', $organization->getDomain());
        $this->assertSame('Acme', $organization->getName());
        $this->assertSame('https://acme.dev/logo.png', $organization->getLogo());
        $this->assertSame('https://crowdin.com/logo.png', $organization->getDefaultLogo());
        $this->assertSame('Public description', $organization->getDescription());
        $this->assertSame('Internal notes', $organization->getInternalDescription());
        $this->assertSame('l10n.acme.dev', $organization->getCname());
        $this->assertTrue($organization->isVendor());
        $this->assertSame('list', $organization->getDefaultPublicProjectsView());
        $this->assertSame('Business', $organization->getPlan()['name']);
        $this->assertSame('projectVisibility', $organization->getDefaults()[0]['name']);
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $organization = new Organization(['id' => 1, 'domain' => 'acme', 'name' => 'Acme']);

        $this->assertNull($organization->getLogo());
        $this->assertNull($organization->getDescription());
        $this->assertNull($organization->getInternalDescription());
        $this->assertNull($organization->getCname());
        $this->assertFalse($organization->isVendor());
    }

    /**
     * @dataProvider isVendorProvider
     * @param mixed $value
     */
    public function testIsVendorAcceptsStringValues($value, bool $expected): void
    {
        $this->assertSame($expected, (new Organization(['isVendor' => $value]))->isVendor());
    }

    public function isVendorProvider(): array
    {
        return [
            'string false' => ['false', false],
            'string true' => ['true', true],
            'bool false' => [false, false],
            'bool true' => [true, true],
        ];
    }
}
