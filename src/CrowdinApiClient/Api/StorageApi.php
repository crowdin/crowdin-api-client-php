<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Storage;
use CrowdinApiClient\ModelCollection;
use SplFileObject;

/**
 * Class StorageApi
 * @package Crowdin\Api
 */
class StorageApi extends AbstractApi
{
    /**
     * @param array $params
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('storages', Storage::class, $params);
    }

    /**
     * @param SplFileObject $fileObject
     * @return Storage|null
     */
    public function create(SplFileObject $fileObject): ?Storage
    {
        $options = [
            'headers' => ['Content-Type' => mime_content_type($fileObject->getRealPath())],
            'body' => file_get_contents($fileObject->getRealPath())
        ];

        return $this->_create('storages', Storage::class, $options);
    }

    /**
     * @param int $storageId
     * @return Storage|null
     */
    public function get(int $storageId): ?Storage
    {
        return $this->_get('storages/' . $storageId, Storage::class);
    }

    /**
     * @param int $storageId
     * @return mixed
     */
    public function delete(int $storageId)
    {
        return $this->_delete('storages/' . $storageId);
    }
}
