<?php


namespace Crowdin;


use Crowdin\Api\ApiInterface;
use Crowdin\Api\StorageApi;
use Crowdin\Http\Client\CrowdinHttpClientFactory;
use Crowdin\Http\Client\CrowdinHttpClientInterface;

/**
 * Class Crowdin
 * @package Crowdin
 *
 * @property StorageApi storage
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

    public function __construct(array $config)
    {
        $config = array_merge([
            'http_client_handler' => null,
            'access_token' => null,
        ], $config);

        $this->baseUri = $config['base_uri'] ?? $this->baseUri;

        $this->accessToken = $config['access_token'];

        $this->client = CrowdinHttpClientFactory::make($config['http_client_handler']);
    }

    public function request(string $method, string $uri, array $options = [])
    {
        $options['body'] = $options['body'] ?? null;

        $options['headers'] = array_merge([
            'Authorization' => 'Bearer '. $this->accessToken,
        ], $options['headers'] ?? []);

        $response = $this->client->request($method, $uri, $options);

        return $response;
    }

    /**
     * @param string $path
     * @return string
     */
    public function getFullUrl(string $path):string
    {
        return $this->baseUri = '/'. ltrim($path);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $services = [
            'storage',
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
