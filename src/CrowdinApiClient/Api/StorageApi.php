<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Http\ResponseDecorator\ResponseModelDecorator;
use CrowdinApiClient\Model\Storage;
use CrowdinApiClient\ModelCollection;
use SplFileInfo;

/**
 * Class StorageApi
 * @package Crowdin\Api
 */
class StorageApi extends AbstractApi
{
    /**
     * List Storages
     *
     * @link https://support.crowdin.com/api/v2/#operation/api.storages.getMany  API Documentation Enterprise
     * @link https://support.crowdin.com/enterprise/api/#operation/api.storages.getMany  API Documentation
     *
     * @param array $params
     * @internal integer $params[limit]
     * @internal integer $params[offset]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('storages', Storage::class, $params);
    }

    /**
     * Add Storage
     *
     * @link https://support.crowdin.com/api/v2/#operation/api.storages.post API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.storages.post API Documentation Enterprise
     *
     * @param SplFileInfo $fileInfo
     * @return Storage|null
     */
    public function create(SplFileInfo $fileInfo): ?Storage
    {
        $options = [
            'headers' => [
                'Crowdin-API-FileName' => $fileInfo->getFilename(),
            ],
            'body' => file_get_contents($fileInfo->getRealPath())
        ];

        return $this->client->apiRequest('post', 'storages', new ResponseModelDecorator(Storage::class), $options);
    }

    /**
     * Get Storage Info
     * @link https://support.crowdin.com/api/v2/#operation/api.storages.get  API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.storages.get  API Documentation Enterprise
     *
     * @param int $storageId
     * @return Storage|null
     */
    public function get(int $storageId): ?Storage
    {
        return $this->_get('storages/' . $storageId, Storage::class);
    }

    /**
     * Delete Storage
     * @link https://support.crowdin.com/api/v2/#operation/api.storages.delete  API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.storages.delete  API Documentation Enterprisse
     *
     * @param int $storageId
     * @return mixed
     */
    public function delete(int $storageId)
    {
        return $this->_delete('storages/' . $storageId);
    }
}
