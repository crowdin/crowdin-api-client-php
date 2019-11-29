<?php

namespace CrowdinApiClient;

use CrowdinApiClient\Api\ApiInterface;
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
 * @property \CrowdinApiClient\Api\StorageApi|\CrowdinApiClient\Api\StorageApi storage
 * @property \CrowdinApiClient\Api\LanguageApi language
 * @property \CrowdinApiClient\Api\Enterprise\GroupApi group
 * @property \CrowdinApiClient\Api\Enterprise\ProjectApi|\CrowdinApiClient\Api\ProjectApi project
 * @property \CrowdinApiClient\Api\BranchApi branch
 * @property \CrowdinApiClient\Api\Enterprise\TaskApi|\CrowdinApiClient\Api\TaskApi task
 * @property \CrowdinApiClient\Api\ScreenshotApi screenshot
 * @property \CrowdinApiClient\Api\DirectoryApi directory
 * @property \CrowdinApiClient\Api\GlossaryApi glossary
 * @property \CrowdinApiClient\Api\StringTranslationApi stringTranslation
 * @property \CrowdinApiClient\Api\StringTranslationApprovalApi stringTranslationApproval
 * @property \CrowdinApiClient\Api\VoteApi vote
 * @property \CrowdinApiClient\Api\Enterprise\UserApi|\CrowdinApiClient\Api\UserApi user
 * @property \CrowdinApiClient\Api\VendorApi vendor
 * @property \CrowdinApiClient\Api\WorkflowTemplateApi workflowTemplate
 * @property \CrowdinApiClient\Api\FileApi file
 * @property \CrowdinApiClient\Api\MachineTranslationEngineApi machineTranslationEngine
 * @property \CrowdinApiClient\Api\Enterprise\ReportApi|\CrowdinApiClient\Api\ReportApi report
 * @property \CrowdinApiClient\Api\SourceStringApi sourceString
 * @property \CrowdinApiClient\Api\Enterprise\TranslationMemoryApi|\CrowdinApiClient\Api\TranslationMemoryApi translationMemory
 * @property \CrowdinApiClient\Api\WebhookApi webhook
 * @property \CrowdinApiClient\Api\Enterprise\TranslationApi|\CrowdinApiClient\Api\TranslationApi translation
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
     * @var bool
     */
    protected $isEnterprise = false;

    /**
     * @var array
     */
    protected $services = [
        'storage',
        'language',
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

    protected $servicesEnterprise = [
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
        if ($this->isEnterprise) {
            $services = $this->servicesEnterprise;
        } else {
            $services = $this->services;
        }

        if (in_array($name, $services)) {
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

        if ($this->isEnterprise) {
            $_class = '\CrowdinApiClient\\Api\\Enterprise\\' . ucfirst($name) . 'Api';

            if(class_exists($_class))
            {
                $class = $_class;
            }
        }

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
        $this->isEnterprise = (bool)$organization;
        $this->updateBaseUri();
    }

    /**
     * @return bool
     */
    public function isEnterprise(): bool
    {
        return $this->isEnterprise;
    }

    /**
     * @param bool $isEnterprise
     */
    public function setIsEnterprise(bool $isEnterprise): void
    {
        $this->isEnterprise = $isEnterprise;
    }
}
