<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Crowdin;
use CrowdinApiClient\Http\ResponseDecorator\ResponseModelDecorator;
use CrowdinApiClient\Http\ResponseDecorator\ResponseModelListDecorator;
use CrowdinApiClient\Model\ModelInterface;

/**
 * @package Crowdin\Api
 * @internal
 */
abstract class AbstractApi implements ApiInterface
{
    /**
     * @var Crowdin
     */
    protected $client;

    /**
     * @var array
     */
    protected $headers = [];

    public function __construct(Crowdin $client)
    {
        $this->client = $client;
        $this->setHeader('Content-Type', 'application/json');
    }

    protected function getHeaders(): array
    {
        return $this->headers;
    }

    protected function setHeader(string $header, string $value): void
    {
        $this->removeHeader($header);
        $this->addHeader($header, $value);
    }

    protected function addHeader(string $header, string $value): void
    {
        $this->headers[strtolower($header)] = $value;
    }

    protected function removeHeader(string $header): void
    {
        unset($this->headers[strtolower($header)]);
    }

    /**
     * @param string $path
     * @param ModelInterface $model
     * @return mixed
     */
    protected function _update(string $path, ModelInterface $model)
    {
        $properties = $model->getProperties();
        $data = [];

        foreach ($model->getData() as $key => $value) {
            $property = $properties[$key] ?? null;

            if (is_object($property) && method_exists($property, 'toArray')) {
                $property = $property->toArray();
            }

            if (isset($property) && $property != $value) {
                $data[] = [
                    'op' => 'replace',
                    'path' => '/' . $key,
                    'value' => $property,
                ];
            }
        }

        if ($data === []) {
            return $model;
        }

        $options = [
            'body' => json_encode($data),
            'headers' => $this->getHeaders(),
        ];

        return $this->client->apiRequest('patch', $path, new ResponseModelDecorator(get_class($model)), $options);
    }

    /**
     * @param string $path
     * @param string $modelName
     * @param array $params
     * @return mixed
     */
    protected function _list(string $path, string $modelName, array $params = [])
    {
        $options = [];

        if (!empty($params)) {
            $options['params'] = $params;
        }

        return $this->client->apiRequest('get', $path, new ResponseModelListDecorator($modelName), $options);
    }

    /**
     * @param string $path
     * @param string $modelName
     * @param array $data
     * @return mixed
     */
    protected function _create(string $path, string $modelName, array $data)
    {
        return $this->_post($path, $modelName, $data);
    }

    /**
     * @param string $path
     * @param array $params
     * @return mixed
     */
    protected function _delete(string $path, array $params = [])
    {
        $options = [];

        if (!empty($params)) {
            $options['params'] = $params;
        }

        return $this->client->apiRequest('delete', $path, null, $options);
    }

    /**
     * @param string $path
     * @param string $modelName
     * @param array $params
     * @return mixed
     */
    protected function _get(string $path, string $modelName, array $params = [])
    {
        $options = [
            'params' => $params,
        ];

        return $this->client->apiRequest('get', $path, new ResponseModelDecorator($modelName), $options);
    }

    /**
     * @param string $path
     * @param string $modelName
     * @param array $data
     * @return mixed
     */
    protected function _put(string $path, string $modelName, array $data)
    {
        $options = [
            'body' => json_encode($data),
            'headers' => $this->getHeaders(),
        ];

        return $this->client->apiRequest('put', $path, new ResponseModelDecorator($modelName), $options);
    }

    /**
     * @param string $path
     * @param string $modelName
     * @param array $data
     * @return mixed
     */
    protected function _post(string $path, string $modelName, array $data)
    {
        $options = [
            'body' => json_encode($data),
            'headers' => $this->getHeaders(),
        ];

        return $this->client->apiRequest('post', $path, new ResponseModelDecorator($modelName), $options);
    }

    /**
     * @param string $path
     * @param string $modelName
     * @param array $body
     * @param array $params
     * @return mixed
     */
    protected function _patch(string $path, string $modelName, array $body, array $params = [])
    {
        $options = [
            'body' => json_encode($body),
            'headers' => $this->getHeaders(),
            'params' => $params,
        ];

        return $this->client->apiRequest('patch', $path, new ResponseModelDecorator($modelName), $options);
    }
}
