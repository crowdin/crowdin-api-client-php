<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\ApplicationData;
use CrowdinApiClient\Model\ApplicationInstallation;
use CrowdinApiClient\ModelCollection;

class ApplicationApiTest extends AbstractTestApi
{
    protected $applicationIdentifier = 'my-application';
    protected $path = 'settings';

    protected function getResponseData(): array
    {
        return [
            'key' => 'value',
            'count' => 1,
        ];
    }

    protected function getResponseJson(): string
    {
        return json_encode([
            'data' => $this->getResponseData(),
        ]);
    }

    protected function getInstallationData(): array
    {
        return [
            'identifier' => 'my-app',
            'name' => 'My Application',
            'installedBy' => ['id' => 1, 'username' => 'admin'],
            'description' => 'App description',
            'logo' => '/resources/images/logo.png',
            'agent' => null,
            'baseUrl' => 'https://localhost.dev',
            'manifestUrl' => 'https://localhost.dev/manifest.json',
            'createdAt' => '2023-11-29T10:00:00+00:00',
            'modules' => [],
            'scopes' => ['application'],
            'permissions' => ['user' => ['value' => 'all']],
            'defaultPermissions' => [],
            'limitReached' => false,
            'stringBasedAvailable' => false,
        ];
    }

    protected function getInstallationResponseJson(): string
    {
        return json_encode(['data' => $this->getInstallationData()]);
    }

    public function testListInstallations(): void
    {
        $this->mockRequest([
            'path' => '/applications/installations',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    ['data' => $this->getInstallationData()],
                ],
                'pagination' => [['offset' => 0, 'limit' => 25]],
            ]),
        ]);

        $list = $this->crowdin->application->listInstallations();

        $this->assertInstanceOf(ModelCollection::class, $list);
        $this->assertCount(1, $list);
        $this->assertInstanceOf(ApplicationInstallation::class, $list[0]);
        $this->assertEquals('my-app', $list[0]->getIdentifier());
        $this->assertEquals('My Application', $list[0]->getName());
    }

    public function testInstallApplication(): void
    {
        $this->mockRequest([
            'path' => '/applications/installations',
            'method' => 'post',
            'body' => json_encode(['url' => 'https://localhost.dev/manifest.json']),
            'response' => $this->getInstallationResponseJson(),
        ]);

        $installation = $this->crowdin->application->installApplication([
            'url' => 'https://localhost.dev/manifest.json',
        ]);

        $this->assertInstanceOf(ApplicationInstallation::class, $installation);
        $this->assertEquals('my-app', $installation->getIdentifier());
        $this->assertEquals('My Application', $installation->getName());
    }

    public function testGetInstallation(): void
    {
        $this->mockRequestGet(
            '/applications/installations/my-app',
            $this->getInstallationResponseJson()
        );

        $installation = $this->crowdin->application->getInstallation('my-app');

        $this->assertInstanceOf(ApplicationInstallation::class, $installation);
        $this->assertEquals('my-app', $installation->getIdentifier());
        $this->assertEquals('My Application', $installation->getName());
    }

    public function testDeleteInstallation(): void
    {
        $this->mockRequestDelete('/applications/installations/my-app');

        $this->crowdin->application->deleteInstallation('my-app');
    }

    public function testUpdateInstallation(): void
    {
        $this->mockRequestPatch(
            '/applications/installations/my-app',
            $this->getInstallationResponseJson()
        );

        $installation = new ApplicationInstallation($this->getInstallationData());
        $installation->setPermissions(['user' => ['value' => 'managers']]);

        $result = $this->crowdin->application->updateInstallation($installation);

        $this->assertInstanceOf(ApplicationInstallation::class, $result);
        $this->assertEquals('my-app', $result->getIdentifier());
    }

    public function testGetApplicationData(): void
    {
        $this->mockRequestGet(
            '/applications/my-application/api/settings',
            $this->getResponseJson()
        );

        $data = $this->crowdin->application->getApplicationData($this->applicationIdentifier, $this->path);

        $this->assertInstanceOf(ApplicationData::class, $data);
        $this->assertEquals($this->getResponseData(), $data->getData());
        $this->assertEquals('value', $data->getDataProperty('key'));
        $this->assertEquals(1, $data->getDataProperty('count'));
    }

    public function testAddApplicationData(): void
    {
        $requestBody = ['key' => 'new-value'];

        $this->mockRequest([
            'path' => '/applications/my-application/api/settings',
            'method' => 'post',
            'body' => json_encode($requestBody),
            'response' => $this->getResponseJson(),
        ]);

        $data = $this->crowdin->application->addApplicationData(
            $this->applicationIdentifier,
            $this->path,
            $requestBody
        );

        $this->assertInstanceOf(ApplicationData::class, $data);
        $this->assertEquals($this->getResponseData(), $data->getData());
    }

    public function testUpdateOrRestoreApplicationData(): void
    {
        $requestBody = ['key' => 'updated-value'];

        $this->mockRequestPut(
            '/applications/my-application/api/settings',
            $this->getResponseJson()
        );

        $data = $this->crowdin->application->updateOrRestoreApplicationData(
            $this->applicationIdentifier,
            $this->path,
            $requestBody
        );

        $this->assertInstanceOf(ApplicationData::class, $data);
        $this->assertEquals($this->getResponseData(), $data->getData());
    }

    public function testDeleteApplicationData(): void
    {
        $this->mockRequestDelete('/applications/my-application/api/settings');

        $this->crowdin->application->deleteApplicationData($this->applicationIdentifier, $this->path);
    }

    public function testEditApplicationData(): void
    {
        $requestBody = ['key' => 'edited-value'];

        $this->mockRequestPatch(
            '/applications/my-application/api/settings',
            $this->getResponseJson()
        );

        $data = $this->crowdin->application->editApplicationData(
            $this->applicationIdentifier,
            $this->path,
            $requestBody
        );

        $this->assertInstanceOf(ApplicationData::class, $data);
        $this->assertEquals($this->getResponseData(), $data->getData());
    }
}
