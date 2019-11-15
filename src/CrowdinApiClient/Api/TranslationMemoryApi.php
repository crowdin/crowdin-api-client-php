<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\TranslationMemory;
use CrowdinApiClient\Model\TranslationMemoryExport;

/**
 * Class TranslationMemoryApi
 * @package Crowdin\Api
 */
class TranslationMemoryApi extends AbstractApi
{
    /**
     * @param int $groupId
     * @param array $params
     * @return mixed
     */
    public function list(int $groupId, array $params = [])
    {
        $params['groupId'] = $groupId;
        return $this->_list('tms', TranslationMemory::class, $params);
    }

    /**
     * @param int $translationMemoryId
     * @return TranslationMemory|null
     */
    public function get(int $translationMemoryId): ?TranslationMemory
    {
        return $this->_get('tms/' . $translationMemoryId, TranslationMemory::class);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->_create('tms', TranslationMemory::class, $data);
    }

    /**
     * @param TranslationMemory $translationMemory
     * @return TranslationMemory|null
     */
    public function update(TranslationMemory $translationMemory): ?TranslationMemory
    {
        return $this->_update('tms/' . $translationMemory->getId(), $translationMemory);
    }

    /**
     * @param int $translationMemoryId
     * @return mixed
     */
    public function delete(int $translationMemoryId)
    {
        return $this->_delete('tms/' . $translationMemoryId);
    }

    /**
     * @param int $translationMemoryId
     * @param array $params
     * @return mixed
     */
    public function download(int $translationMemoryId, $params = [])
    {
        $path = sprintf('tms/%d/exports', $translationMemoryId);
        return $this->_get($path, DownloadFile::class, $params);
    }

    /**
     * @param int $translationMemoryId
     * @param array $params
     * @return TranslationMemoryExport|null
     */
    public function export(int $translationMemoryId, array $params = []): ?TranslationMemoryExport
    {
        $path = sprintf('tms/%d/exports', $translationMemoryId);
        return $this->_post($path, TranslationMemoryExport::class, $params);
    }

    /**
     * @param int $translationMemoryId
     * @param string $exportId
     * @return TranslationMemoryExport|null
     */
    public function checkExportStatus(int $translationMemoryId, string $exportId): ?TranslationMemoryExport
    {
        $path = sprintf('tms/%d/exports/%s', $translationMemoryId, $exportId);
        return $this->_get($path, TranslationMemoryExport::class);
    }

    /**
     * @param int $translationMemoryId
     * @param int $storageId
     * @param bool $firstLineContainsHeader
     * @param array $scheme
     * @return TranslationMemoryExport|null
     */
    public function import(int $translationMemoryId, int $storageId, $firstLineContainsHeader = false, array $scheme = []): ?TranslationMemoryExport
    {
        $path = sprintf('tms/%d/imports', $translationMemoryId);
        $params = [
            'storageId' => $storageId,
            'firstLineContainsHeader' => $firstLineContainsHeader,
            'scheme' => $scheme
        ];

        return $this->_create($path, TranslationMemoryExport::class, $params);
    }

    /**
     * @param int $translationMemoryId
     * @param string $importId
     * @return TranslationMemoryExport|null
     */
    public function checkImportStatus(int $translationMemoryId, string $importId): ?TranslationMemoryExport
    {
        $path = sprintf('tms/%d/imports/%s', $translationMemoryId, $importId);
        return $this->_get($path, TranslationMemoryExport::class);
    }
}
