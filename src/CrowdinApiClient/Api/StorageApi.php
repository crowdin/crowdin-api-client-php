<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Http\ResponseDecorator\ResponseModelDecorator;
use CrowdinApiClient\Model\Storage;
use CrowdinApiClient\ModelCollection;
use SplFileInfo;

/**
 * Storage is a separate container for each file. You need to use Add Storage method before adding files to your projects via API.
 * Files that should be uploaded into storage include files for localization, screenshots, Glossaries, and Translation Memories.
 * Storage id is the identifier of the file uploaded to the Storage.
 *
 * Note: Files uploaded to the storage are kept during the next 24 hours
 *
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
     * integer $params[limit]<br>
     * integer $params[offset]
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
                'Content-Type' => 'application/octet-stream',
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
