<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\ApplicationData;

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

        $this->mockRequest([
            'path' => '/applications/my-application/api/settings',
            'method' => 'put',
            'body' => json_encode($requestBody),
            'response' => $this->getResponseJson(),
        ]);

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

        $this->mockRequest([
            'path' => '/applications/my-application/api/settings',
            'method' => 'patch',
            'body' => json_encode($requestBody),
            'response' => $this->getResponseJson(),
        ]);

        $data = $this->crowdin->application->editApplicationData(
            $this->applicationIdentifier,
            $this->path,
            $requestBody
        );

        $this->assertInstanceOf(ApplicationData::class, $data);
        $this->assertEquals($this->getResponseData(), $data->getData());
    }
}
