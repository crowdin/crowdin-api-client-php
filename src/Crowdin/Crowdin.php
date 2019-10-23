<?php


namespace Crowdin;


use Crowdin\Api\ApiInterface;
use Crowdin\Http\Client\CrowdinHttpClientFactory;
use Crowdin\Http\Client\CrowdinHttpClientInterface;
use Crowdin\Http\ResponseDecorator\ResponseDecoratorInterface;
use Crowdin\Http\ResponseErrorHandlerFactory;
use Crowdin\Http\ResponseErrorHandlerInterface;

/**
 * Class Crowdin
 * @package Crowdin
 *
 * @property \Crowdin\Api\StorageApi storage
 * @property \Crowdin\Api\LanguageApi language
 * @property \Crowdin\Api\GroupApi group
 * @property \Crowdin\Api\ProjectApi project
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



    public function __construct(array $config)
    {
        $config = array_merge([
            'http_client_handler' => null,
            'response_error_handler' => null,
            'access_token' => null,
        ], $config);

        $this->baseUri = $config['base_uri'] ?? $this->baseUri;

        $this->accessToken = $config['access_token'];

        $this->client = CrowdinHttpClientFactory::make($config['http_client_handler']);
        $this->responseErrorHandler = ResponseErrorHandlerFactory::make($config['response_error_handler']);
    }

    public function request(string $method, string $uri, array $options = [])
    {
        $options['body'] = $options['body'] ?? null;

        $options['headers'] = array_merge([
            'Authorization' => 'Bearer '. $this->accessToken,
          //  'Content-Type' => 'application/json',
        ], $options['headers'] ?? []);

        $response = $this->client->request($method, $uri, $options);

        return $response;
    }

    public function apiRequest(string $method, string $path, ResponseDecoratorInterface $decorator = null, array $options = [])
    {
        $response = $this->request($method, $this->getFullUrl($path), $options);

        $response = json_decode($response, true);

        //TODO
        $this->responseErrorHandler->check($response);

        if($decorator instanceof ResponseDecoratorInterface)
        {
            //TODO
            if(isset($response['data']))
            {
                $response = $decorator->decorate($response['data']);
            }
        }

        var_dump($response);
        return $response;
    }

    /**
     * @param string $path
     * @return string
     */
    public function getFullUrl(string $path):string
    {
        return $this->baseUri = $this->baseUri. '/'. ltrim($path);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $services = [
            'storage',
            'language',
            'group',
            'project'
        ];

        //TODO
        if (in_array($name, $services)) {
            return $this->getApi($name);
        }

        throw new \UnexpectedValueException(sprintf('Invalid property: %s', $name));
    }


    /**
     * @param string $name
     * @return ApiInterface
     */
    public function getApi(string $name):ApiInterface
    {
        $class = '\Crowdin\\Api\\' . ucfirst($name) . 'Api';

        if (!array_key_exists($class, $this->apis))
        {
            $this->apis[$class] = new $class($this);
        }

        return $this->apis[$class];
    }

}
