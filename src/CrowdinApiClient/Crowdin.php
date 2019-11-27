<?php

namespace CrowdinApiClient;

use CrowdinApiClient\Api\ApiInterface;
use CrowdinApiClient\Api\BranchApi;
use CrowdinApiClient\Api\DirectoryApi;
use CrowdinApiClient\Api\FileApi;
use CrowdinApiClient\Api\GlossaryApi;
use CrowdinApiClient\Api\GroupApi;
use CrowdinApiClient\Api\LanguageApi;
use CrowdinApiClient\Api\MachineTranslationEngineApi;
use CrowdinApiClient\Api\ProjectApi;
use CrowdinApiClient\Api\ReportApi;
use CrowdinApiClient\Api\ScreenshotApi;
use CrowdinApiClient\Api\SourceStringApi;
use CrowdinApiClient\Api\StorageApi;
use CrowdinApiClient\Api\StringTranslationApi;
use CrowdinApiClient\Api\StringTranslationApprovalApi;
use CrowdinApiClient\Api\TaskApi;
use CrowdinApiClient\Api\TranslationApi;
use CrowdinApiClient\Api\TranslationMemoryApi;
use CrowdinApiClient\Api\UserApi;
use CrowdinApiClient\Api\VendorApi;
use CrowdinApiClient\Api\VoteApi;
use CrowdinApiClient\Api\WebhookApi;
use CrowdinApiClient\Api\WorkflowTemplateApi;
use CrowdinApiClient\Http\Client\CrowdinHttpClientFactory;
use CrowdinApiClient\Http\Client\CrowdinHttpClientInterface;
use CrowdinApiClient\Http\ResponseDecorator\ResponseDecoratorInterface;
use CrowdinApiClient\Http\ResponseErrorHandlerFactory;
use CrowdinApiClient\Http\ResponseErrorHandlerInterface;
use UnexpectedValueException;

/**
 * Class Crowdin
 * @package Crowdin
 *
 * @property StorageApi storage
 * @property LanguageApi language
 * @property GroupApi group
 * @property ProjectApi project
 * @property BranchApi branch
 * @property TaskApi task
 * @property ScreenshotApi screenshot
 * @property DirectoryApi directory
 * @property GlossaryApi glossary
 * @property StringTranslationApi stringTranslation
 * @property StringTranslationApprovalApi stringTranslationApproval
 * @property VoteApi vote
 * @property UserApi user
 * @property VendorApi vendor
 * @property WorkflowTemplateApi workflowTemplate
 * @property FileApi file
 * @property MachineTranslationEngineApi machineTranslationEngine
 * @property ReportApi report
 * @property SourceStringApi sourceString
 * @property TranslationMemoryApi translationMemory
 * @property WebhookApi webhook
 * @property TranslationApi translation
 */
class Crowdin
{
    /**
     * @var CrowdinHttpClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var array
     */
    protected $apis = [];

    /**
     * @var string
     */
    protected $baseUri = 'https://api.crowdin.com/api/v2';

    /**
     * @var ResponseErrorHandlerInterface
     */
    protected $responseErrorHandler;

    /**
     * @var string
     */
    protected $organization;

    /**
     * @var array
     */
    protected $services = [
        'storage',
        'language',
        'group',
        'project',
        'task',
        'branch',
        'glossary',
        'stringTranslation',
        'stringTranslationApproval',
        'directory',
        'vote',
        'vendor',
        'user',
        'screenshot',
        'workflowTemplate',
        'file',
        'machineTranslationEngine',
        'report',
        'sourceString',
        'translationMemory',
        'webhook',
        'translation',
    ];

    /**
     * Crowdin constructor.
     * @param array $config
     * @internal mixed $config[http_client_handler]
     * @internal mixed $config[response_error_handler]
     * @internal string $config[access_token]
     * @internal string $config[base_uri]
     */
    public function __construct(array $config)
    {
        $config = array_merge([
            'http_client_handler' => null,
            'response_error_handler' => null,
            'access_token' => null,
            'organization' => null
        ], $config);

        $this->accessToken = $config['access_token'];

        $this->setOrganization($config['organization']);

        $this->client = CrowdinHttpClientFactory::make($config['http_client_handler']);
        $this->responseErrorHandler = ResponseErrorHandlerFactory::make($config['response_error_handler']);
    }

    /**
     * @return $this
     */
    protected function updateBaseUri()
    {
        $this->baseUri = sprintf('https://%s.crowdin.com/api/v2', $this->organization ?? 'api');
        return $this;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return mixed
     */
    public function request(string $method, string $uri, array $options = [])
    {
        $options['body'] = $options['body'] ?? null;

        $options['headers'] = array_merge([
            'Authorization' => 'Bearer ' . $this->accessToken,
        ], $options['headers'] ?? []);

        $response = $this->client->request($method, $uri, $options);

        return $response;
    }

    /**
     * @param string $method
     * @param string $path
     * @param ResponseDecoratorInterface|null $decorator
     * @param array $options
     * @return mixed
     */
    public function apiRequest(string $method, string $path, ResponseDecoratorInterface $decorator = null, array $options = [])
    {
        $response = $this->request($method, $this->getFullUrl($path), $options);

        $response = json_decode($response, true);

        $this->responseErrorHandler->check($response);

        if ($decorator instanceof ResponseDecoratorInterface) {
            if (isset($response['data']) && isset($response['pagination'])) {
                $response = $decorator->decorate($response);
            } elseif (isset($response['data'])) {
                $response = $decorator->decorate($response['data']);
            } else {
                $response = $decorator->decorate($response);
            }
        }

        return $response;
    }

    /**
     * @param string $path
     * @return string
     */
    public function getFullUrl(string $path): string
    {
        return $this->baseUri . '/' . ltrim($path);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (in_array($name, $this->services)) {
            return $this->getApi($name);
        }

        throw new UnexpectedValueException(sprintf('Invalid property: %s', $name));
    }

    /**
     * @param string $name
     * @return ApiInterface
     */
    public function getApi(string $name): ApiInterface
    {
        $class = '\CrowdinApiClient\\Api\\' . ucfirst($name) . 'Api';

        if (!array_key_exists($class, $this->apis)) {
            $this->apis[$class] = new $class($this);
        }

        return $this->apis[$class];
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri
     */
    public function setBaseUri(string $baseUri): void
    {
        $this->baseUri = rtrim($baseUri, '/');
    }

    /**
     * @return CrowdinHttpClientInterface
     */
    public function getClient(): CrowdinHttpClientInterface
    {
        return $this->client;
    }

    /**
     * @param CrowdinHttpClientInterface $client
     */
    public function setClient(CrowdinHttpClientInterface $client): void
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return ResponseErrorHandlerInterface
     */
    public function getResponseErrorHandler(): ResponseErrorHandlerInterface
    {
        return $this->responseErrorHandler;
    }

    /**
     * @param ResponseErrorHandlerInterface $responseErrorHandler
     */
    public function setResponseErrorHandler(ResponseErrorHandlerInterface $responseErrorHandler): void
    {
        $this->responseErrorHandler = $responseErrorHandler;
    }

    /**
     * @return string|null
     */
    public function getOrganization(): ?string
    {
        return $this->organization;
    }

    /**
     * @param string|null $organization
     */
    public function setOrganization(?string $organization): void
    {
        $this->organization = $organization;
        $this->updateBaseUri();
    }
}
