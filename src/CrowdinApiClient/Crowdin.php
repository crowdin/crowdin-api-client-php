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
 * @property \CrowdinApiClient\Api\StorageApi storage
 * @property \CrowdinApiClient\Api\LanguageApi language
 * @property \CrowdinApiClient\Api\Enterprise\GroupApi group
 * @property \CrowdinApiClient\Api\ProjectApi project
 * @property \CrowdinApiClient\Api\BranchApi branch
 * @property \CrowdinApiClient\Api\TaskApi task
 * @property \CrowdinApiClient\Api\IssueApi issue
 * @property \CrowdinApiClient\Api\ScreenshotApi screenshot
 * @property \CrowdinApiClient\Api\DirectoryApi directory
 * @property \CrowdinApiClient\Api\LabelApi label
 * @property \CrowdinApiClient\Api\GlossaryApi glossary
 * @property \CrowdinApiClient\Api\StringTranslationApi stringTranslation
 * @property \CrowdinApiClient\Api\StringCommentApi stringComment
 * @property \CrowdinApiClient\Api\Enterprise\UserApi|\CrowdinApiClient\Api\UserApi user
 * @property \CrowdinApiClient\Api\Enterprise\VendorApi vendor
 * @property \CrowdinApiClient\Api\Enterprise\WorkflowTemplateApi workflowTemplate
 * @property \CrowdinApiClient\Api\Enterprise\WorkflowStepApi workflowStep
 * @property \CrowdinApiClient\Api\FileApi|\CrowdinApiClient\Api\Enterprise\FileApi file
 * @property \CrowdinApiClient\Api\ReportApi report
 * @property \CrowdinApiClient\Api\SourceStringApi sourceString
 * @property \CrowdinApiClient\Api\TranslationMemoryApi translationMemory
 * @property \CrowdinApiClient\Api\WebhookApi webhook
 * @property \CrowdinApiClient\Api\TranslationApi translation
 * @property \CrowdinApiClient\Api\TranslationStatusApi translationStatus
 * @property \CrowdinApiClient\Api\DistributionApi distribution
 * @property \CrowdinApiClient\Api\Enterprise\TeamApi team
 * @property \CrowdinApiClient\Api\Enterprise\TeamMemberApi teamMember
 * @property \CrowdinApiClient\Api\BundleApi bundle
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
    public $responseErrorHandler;

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
        'issue',
        'branch',
        'glossary',
        'stringTranslation',
        'stringComment',
        'directory',
        'label',
        'user',
        'screenshot',
        'file',
        'report',
        'sourceString',
        'translationMemory',
        'webhook',
        'translation',
        'translationStatus',
        'distribution',
        'bundle'
    ];

    protected $servicesEnterprise = [
        'storage',
        'language',
        'group',
        'project',
        'task',
        'issue',
        'branch',
        'glossary',
        'stringTranslation',
        'stringTranslationApproval',
        'stringComment',
        'directory',
        'label',
        'vendor',
        'user',
        'screenshot',
        'workflowTemplate',
        'workflowStep',
        'file',
        'machineTranslationEngine',
        'report',
        'sourceString',
        'translationMemory',
        'webhook',
        'translation',
        'translationStatus',
        'distribution',
        'team',
        'teamMember',
        'bundle'
    ];

    /**
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
            } elseif (is_array($response)) {
                $response = $decorator->decorate($response);
            } else {
                $response = null;
            }
        }

        return $response;
    }

    /**
     * @internal
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

    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    public function setBaseUri(string $baseUri): void
    {
        $this->baseUri = rtrim($baseUri, '/');
    }

    public function getClient(): CrowdinHttpClientInterface
    {
        return $this->client;
    }

    public function setClient(CrowdinHttpClientInterface $client): void
    {
        $this->client = $client;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    public function getResponseErrorHandler(): ResponseErrorHandlerInterface
    {
        return $this->responseErrorHandler;
    }

    public function setResponseErrorHandler(ResponseErrorHandlerInterface $responseErrorHandler): void
    {
        $this->responseErrorHandler = $responseErrorHandler;
    }

    public function setOrganization(?string $organization): void
    {
        $this->organization = $organization;
        $this->isEnterprise = (bool)$organization;
        $this->updateBaseUri();
    }

    protected function updateBaseUri(): self
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
    protected function request(string $method, string $uri, array $options = [])
    {
        $options['body'] = $options['body'] ?? null;

        $options['headers'] = array_merge([
            'Authorization' => 'Bearer ' . $this->accessToken,
        ], $options['headers'] ?? []);

        if (!empty($options['params'])) {
            $uri .= '?' . http_build_query($options['params']);
            $options['body'] = null;
        }
        $response = $this->client->request($method, $uri, $options);

        return $response;
    }

    /**
     * @internal
     * @param string $name
     * @return ApiInterface
     */
    protected function getApi(string $name): ApiInterface
    {
        $class = '\CrowdinApiClient\\Api\\' . ucfirst($name) . 'Api';

        if ($this->isEnterprise) {
            $_class = '\CrowdinApiClient\\Api\\Enterprise\\' . ucfirst($name) . 'Api';

            if (class_exists($_class)) {
                $class = $_class;
            }
        }

        if (!array_key_exists($class, $this->apis)) {
            $this->apis[$class] = new $class($this);
        }

        return $this->apis[$class];
    }

    protected function getFullUrl(string $path): string
    {
        return $this->baseUri . '/' . ltrim($path);
    }
}
