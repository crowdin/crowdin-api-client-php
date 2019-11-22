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

    protected function setUp()
    {
        $this->app = new Crowdin([
            'access_token' => 'token',
            'base_uri' => 'https://organization_domain.crowdin.com/api/v2',
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
            ['group',  \CrowdinApiClient\Api\GroupApi::class],
            ['project', \CrowdinApiClient\Api\ProjectApi::class],
            ['branch', \CrowdinApiClient\Api\BranchApi::class],
            ['task', \CrowdinApiClient\Api\TaskApi::class],
            ['screenshot', \CrowdinApiClient\Api\ScreenshotApi::class],
            ['directory', \CrowdinApiClient\Api\DirectoryApi::class],
            ['glossary', \CrowdinApiClient\Api\GlossaryApi::class],
            ['stringTranslation', \CrowdinApiClient\Api\StringTranslationApi::class],
            ['stringTranslationApproval', \CrowdinApiClient\Api\StringTranslationApprovalApi::class],
            ['vote', \CrowdinApiClient\Api\VoteApi::class],
            ['user', \CrowdinApiClient\Api\UserApi::class],
            ['vendor', \CrowdinApiClient\Api\VendorApi::class],
            ['workflowTemplate', \CrowdinApiClient\Api\WorkflowTemplateApi::class],
            ['file', \CrowdinApiClient\Api\FileApi::class],
            ['machineTranslationEngine', \CrowdinApiClient\Api\MachineTranslationEngineApi::class],
            ['report', \CrowdinApiClient\Api\ReportApi::class],
            ['sourceString', \CrowdinApiClient\Api\SourceStringApi::class],
            ['translationMemory', \CrowdinApiClient\Api\TranslationMemoryApi::class],
            ['webhook', \CrowdinApiClient\Api\WebhookApi::class],
            ['translation', \CrowdinApiClient\Api\TranslationApi::class],
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidClientHandler()
    {
        $crowdin = new Crowdin([
            'http_client_handler' => 'http_client_handler'
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidResponseErrorHandler()
    {
        $crowdin = new Crowdin([
            'response_error_handler' => 'response_error_handler'
        ]);
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testGetApiUnexpectedValueException()
    {
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
}
