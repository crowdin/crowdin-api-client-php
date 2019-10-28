<?php


namespace Crowdin\Api\Traits;

use Crowdin\Api\Service\ModelUpdateService;
use Crowdin\Crowdin;
use Crowdin\Http\ResponseDecorator\ResponseModelDecorator;
use Crowdin\Http\ResponseDecorator\ResponseModelListDecorator;
use Crowdin\Model\ModelInterface;

/**
 * Class UpdateTrait
 * @package Crowdin\Api\Traits
 * @property Crowdin $client
 */
trait GrudTrait
{
    /**
     * @param string $path
     * @param ModelInterface $model
     * @return mixed
     */
    protected function _update(string $path, ModelInterface $model)
    {
        $data = (new ModelUpdateService($model, $this))->getUpdateData();

        if(empty($data))
        {
            return $model;
        }

        $options = [
            'body' => json_encode($data),
            'headers' => ['Content-Type' => 'application/json']
        ];

        return $this->client->apiRequest('PATCH', $path. '/' . $model->getId(), new ResponseModelDecorator(get_class($model)), $options);

    }

    /**
     * @param string $path
     * @param string $modelName
     * @return mixed
     */
    protected function _list(string $path, string $modelName)
    {

        //TODO paginator
        return $this->client->apiRequest('get', $path, new ResponseModelListDecorator($modelName));
    }

    /**
     * @param string $path
     * @param string $modelName
     * @param array $data
     * @return mixed
     */
    protected function _create(string $path, string $modelName, array $data)
    {
        //TODO validate and form model
        $options = [
            'body' => json_encode($data),
            'headers' => ['Content-Type' => 'application/json']
        ];

        return $this->client->apiRequest('post', $path, new ResponseModelDecorator($modelName), $options);
    }

    /**
     * @param string $path
     * @return mixed
     */
    protected function _delete(string $path)
    {
        return $this->client->apiRequest('delete', $path);
    }

    /**
     * @param string $path
     * @param string $modelName
     * @return mixed
     */
    public function _get(string $path,  string $modelName)
    {
        return $this->client->apiRequest('get', $path, new ResponseModelDecorator($modelName));
    }
}
