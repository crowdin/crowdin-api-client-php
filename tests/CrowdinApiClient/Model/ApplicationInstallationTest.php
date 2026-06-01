<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\ApplicationInstallation;
use PHPUnit\Framework\TestCase;

class ApplicationInstallationTest extends TestCase
{
    protected $model;

    protected function setUp(): void
    {
        $this->model = new ApplicationInstallation([
            'identifier' => 'my-app',
            'name' => 'My Application',
            'installedBy' => ['id' => 1, 'username' => 'admin'],
            'description' => 'App description',
            'logo' => '/resources/images/logo.png',
            'agent' => null,
            'baseUrl' => 'https://localhost.dev',
            'manifestUrl' => 'https://localhost.dev/manifest.json',
            'createdAt' => '2023-11-29T10:00:00+00:00',
            'modules' => [['key' => 'module-1', 'type' => 'custom']],
            'scopes' => ['application'],
            'permissions' => ['user' => ['value' => 'all'], 'project' => ['value' => 'own']],
            'defaultPermissions' => ['user' => ['value' => 'all']],
            'limitReached' => false,
            'stringBasedAvailable' => true,
        ]);
    }

    public function testGetIdentifier(): void
    {
        $this->assertEquals('my-app', $this->model->getIdentifier());
    }

    public function testGetName(): void
    {
        $this->assertEquals('My Application', $this->model->getName());
    }

    public function testGetInstalledBy(): void
    {
        $this->assertEquals(['id' => 1, 'username' => 'admin'], $this->model->getInstalledBy());
    }

    public function testGetDescription(): void
    {
        $this->assertEquals('App description', $this->model->getDescription());
    }

    public function testGetLogo(): void
    {
        $this->assertEquals('/resources/images/logo.png', $this->model->getLogo());
    }

    public function testGetAgent(): void
    {
        $this->assertNull($this->model->getAgent());
    }

    public function testGetBaseUrl(): void
    {
        $this->assertEquals('https://localhost.dev', $this->model->getBaseUrl());
    }

    public function testGetManifestUrl(): void
    {
        $this->assertEquals('https://localhost.dev/manifest.json', $this->model->getManifestUrl());
    }

    public function testGetCreatedAt(): void
    {
        $this->assertEquals('2023-11-29T10:00:00+00:00', $this->model->getCreatedAt());
    }

    public function testGetModules(): void
    {
        $this->assertEquals([['key' => 'module-1', 'type' => 'custom']], $this->model->getModules());
    }

    public function testGetScopes(): void
    {
        $this->assertEquals(['application'], $this->model->getScopes());
    }

    public function testGetPermissions(): void
    {
        $this->assertEquals(
            ['user' => ['value' => 'all'], 'project' => ['value' => 'own']],
            $this->model->getPermissions()
        );
    }

    public function testGetDefaultPermissions(): void
    {
        $this->assertEquals(['user' => ['value' => 'all']], $this->model->getDefaultPermissions());
    }

    public function testIsLimitReached(): void
    {
        $this->assertFalse($this->model->isLimitReached());
    }

    public function testIsStringBasedAvailable(): void
    {
        $this->assertTrue($this->model->isStringBasedAvailable());
    }

    public function testSetPermissions(): void
    {
        $newPermissions = ['user' => ['value' => 'managers']];
        $this->model->setPermissions($newPermissions);
        $this->assertEquals($newPermissions, $this->model->getPermissions());
    }

    public function testSetModules(): void
    {
        $newModules = [['key' => 'module-2', 'type' => 'custom']];
        $this->model->setModules($newModules);
        $this->assertEquals($newModules, $this->model->getModules());
    }
}
