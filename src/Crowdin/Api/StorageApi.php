<?php

namespace Crowdin\Api;

use SplFileObject;

/**
 * Class StorageApi
 * @package Crowdin\Api
 *
 */
class StorageApi extends AbstractApi
{
    public function list()
    {
        //TODO decorate response
        return $this->client->request('get', $this->client->getFullUrl('storages'));
    }

    public function add(SplFileObject $fileObject)
    {
        //TODO
        $options = [
            'headers' => ['Content-Type' => $fileObject->getType()],
            'body' => file_get_contents($fileObject->getRealPath())
        ];

        return $this->client->request('post', $this->client->getFullUrl('storages'), $options);
    }

    public function getInfo(int $storageId)
    {
        return $this->client->request('get', $this->client->getFullUrl('storages/' . $storageId), []);
    }

    public function delete(int $storageId)
    {
        return $this->client->request('delete', $this->client->getFullUrl('/storages/' . $storageId), []);
    }
}
