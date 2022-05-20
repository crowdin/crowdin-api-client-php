<?php

namespace CrowdinApiClient\Tests;

use CrowdinApiClient\Crowdin;
use CrowdinApiClient\Http\Client\CrowdinHttpClientInterface;
use CrowdinApiClient\Http\Client\CurlHttpClient;
use CrowdinApiClient\Http\ResponseErrorHandler;
use CrowdinApiClient\Http\ResponseErrorHandlerInterface;
use PHPUnit\Framework\TestCase;

class CrowdinTest extends TestCase
{

    /**
     * @var Crowdin
     */
    private $app;

    protected function setUp(): void
    {
        $this->app = new Crowdin([
            'access_token' => 'token',
            'organization' => 'organization_domain',
        ]);
    }

    public function testGetBaseUrl()
    {
        $this->assertEquals('https://organization_domain.crowdin.com/api/v2', $this->app->getBaseUri());
    }

    public function testGetAccessToken()
    {
        $this->assertEquals('token', $this->app->getAccessToken());
    }

    public function testGetClient()
    {
        $this->assertInstanceOf(CrowdinHttpClientInterface::class, $this->app->getClient());
    }

    public function testResponseErrorHandler()
    {
        $this->assertInstanceOf(ResponseErrorHandlerInterface::class, $this->app->getResponseErrorHandler());
    }

    public function testSerialization()
    {
        /**
         * @var Crowdin
         */
        $newApp = unserialize(serialize($this->app));

        $this->assertInstanceOf(Crowdin::class, $newApp);
        $this->assertEquals('token', $newApp->getAccessToken());
    }

    /**
     * @test
     * @dataProvider getApiClassesProvider
     * @param string $apiName
     * @param string $class
     */
    public function testShouldGetApiInstance(string $apiName, string $class)
    {
        $crowdin = new Crowdin([]);

        $this->assertInstanceOf($class, $crowdin->{$apiName});
    }
    /**
     * @return array
     */
    public function getApiClassesProvider(): array
    {
        return [
            ['storage', \CrowdinApiClient\Api\StorageApi::class],
            ['language', \CrowdinApiClient\Api\LanguageApi::class],
            ['project', \CrowdinApiClient\Api\ProjectApi::class],
            ['branch', \CrowdinApiClient\Api\BranchApi::class],
            ['task', \CrowdinApiClient\Api\TaskApi::class],
            ['screenshot', \CrowdinApiClient\Api\ScreenshotApi::class],
            ['directory', \CrowdinApiClient\Api\DirectoryApi::class],
            ['label', \CrowdinApiClient\Api\LabelApi::class],
            ['glossary', \CrowdinApiClient\Api\GlossaryApi::class],
            ['stringTranslation', \CrowdinApiClient\Api\StringTranslationApi::class],
            ['user', \CrowdinApiClient\Api\UserApi::class],
            ['file', \CrowdinApiClient\Api\FileApi::class],
            ['report', \CrowdinApiClient\Api\ReportApi::class],
            ['sourceString', \CrowdinApiClient\Api\SourceStringApi::class],
            ['translationMemory', \CrowdinApiClient\Api\TranslationMemoryApi::class],
            ['webhook', \CrowdinApiClient\Api\WebhookApi::class],
            ['translation', \CrowdinApiClient\Api\TranslationApi::class],
            ['translationStatus', \CrowdinApiClient\Api\TranslationStatusApi::class],
            ['distribution', \CrowdinApiClient\Api\DistributionApi::class],
        ];
    }

    /**
     * @test
     * @dataProvider getApiClassesEnterpriseProvider
     * @param string $apiName
     * @param string $class
     */
    public function testShouldGetApiEnterpriseInstance(string $apiName, string $class)
    {
        $crowdin = new Crowdin(['organization' => 'organization']);

        $this->assertInstanceOf($class, $crowdin->{$apiName});
    }
    /**
     * @return array
     */
    public function getApiClassesEnterpriseProvider(): array
    {
        return [
            ['storage', \CrowdinApiClient\Api\StorageApi::class],
            ['language', \CrowdinApiClient\Api\LanguageApi::class],
            ['project', \CrowdinApiClient\Api\ProjectApi::class],
            ['branch', \CrowdinApiClient\Api\BranchApi::class],
            ['task', \CrowdinApiClient\Api\TaskApi::class],
            ['screenshot', \CrowdinApiClient\Api\ScreenshotApi::class],
            ['glossary', \CrowdinApiClient\Api\GlossaryApi::class],
            ['stringTranslation', \CrowdinApiClient\Api\StringTranslationApi::class],
            ['user', \CrowdinApiClient\Api\Enterprise\UserApi::class],
            ['vendor', \CrowdinApiClient\Api\Enterprise\VendorApi::class],
            ['workflowTemplate', \CrowdinApiClient\Api\Enterprise\WorkflowTemplateApi::class],
            ['file', \CrowdinApiClient\Api\Enterprise\FileApi::class],
            ['machineTranslationEngine', \CrowdinApiClient\Api\Enterprise\MachineTranslationEngineApi::class],
            ['report', \CrowdinApiClient\Api\ReportApi::class],
            ['sourceString', \CrowdinApiClient\Api\SourceStringApi::class],
            ['translationMemory', \CrowdinApiClient\Api\TranslationMemoryApi::class],
            ['webhook', \CrowdinApiClient\Api\WebhookApi::class],
            ['translation', \CrowdinApiClient\Api\TranslationApi::class],
            ['translationStatus', \CrowdinApiClient\Api\TranslationStatusApi::class],
            ['distribution', \CrowdinApiClient\Api\DistributionApi::class],
            ['team', \CrowdinApiClient\Api\Enterprise\TeamApi::class],
        ];
    }

    public function testInvalidClientHandler()
    {
        $this->expectException(\InvalidArgumentException::class);
        $crowdin = new Crowdin([
            'http_client_handler' => 'http_client_handler'
        ]);
    }

    public function testInvalidResponseErrorHandler()
    {
        $this->expectException(\InvalidArgumentException::class);
        $crowdin = new Crowdin([
            'response_error_handler' => 'response_error_handler'
        ]);
    }

    public function testGetApiUnexpectedValueException()
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->app->test;
    }

    public function testSetBaseUri()
    {
        $this->app->setBaseUri('https://foo.com');
        $this->assertEquals('https://foo.com', $this->app->getBaseUri());
    }

    public function testSetGet()
    {
        $this->app->setClient(new CurlHttpClient());
        $this->assertInstanceOf(CrowdinHttpClientInterface::class, $this->app->getClient());

        $this->app->setAccessToken('token');
        $this->assertEquals('token', $this->app->getAccessToken());

        $this->app->setResponseErrorHandler(new ResponseErrorHandler());
        $this->assertInstanceOf(ResponseErrorHandler::class, $this->app->getResponseErrorHandler());
    }

    public function testBaseUrl()
    {
        $crowdin = new Crowdin([
            'access_token' => 'token',
        ]);

        $this->assertEquals('https://api.crowdin.com/api/v2', $crowdin->getBaseUri());

        $crowdin->setOrganization('organization_name');

        $this->assertEquals('https://organization_name.crowdin.com/api/v2', $crowdin->getBaseUri());
    }
}
