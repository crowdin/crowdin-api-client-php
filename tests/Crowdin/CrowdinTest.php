<?php

namespace Crowdin\Tests;

use Crowdin\Crowdin;
use Crowdin\Http\Client\CrowdinHttpClientInterface;
use Crowdin\Http\ResponseErrorHandlerInterface;
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
            ['storage', \Crowdin\Api\StorageApi::class],
            ['language', \Crowdin\Api\LanguageApi::class],
            ['group',  \Crowdin\Api\GroupApi::class],
            ['project', \Crowdin\Api\ProjectApi::class],
            ['branch', \Crowdin\Api\BranchApi::class],
            ['task', \Crowdin\Api\TaskApi::class],
            ['screenshot', \Crowdin\Api\ScreenshotApi::class],
            ['directory', \Crowdin\Api\DirectoryApi::class],
            ['glossary', \Crowdin\Api\GlossaryApi::class],
            ['stringTranslation', \Crowdin\Api\StringTranslationApi::class],
            ['stringTranslationApproval', \Crowdin\Api\StringTranslationApprovalApi::class],
            ['vote', \Crowdin\Api\VoteApi::class],
            ['user', \Crowdin\Api\UserApi::class],
            ['vendor', \Crowdin\Api\VendorApi::class],
            ['workflowTemplate', \Crowdin\Api\WorkflowTemplateApi::class],
            ['file', \Crowdin\Api\FileApi::class],
            ['machineTranslationEngine', \Crowdin\Api\MachineTranslationEngineApi::class],
            ['report', \Crowdin\Api\ReportApi::class],
            ['sourceString', \Crowdin\Api\SourceStringApi::class],
            ['translationMemory', \Crowdin\Api\TranslationMemoryApi::class],
            ['webhook', \Crowdin\Api\WebhookApi::class],
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
}
