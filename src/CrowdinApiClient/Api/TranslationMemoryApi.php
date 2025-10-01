<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Http\ResponseDecorator\ResponseModelListDecorator;
use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\TranslationMemory;
use CrowdinApiClient\Model\TranslationMemoryConcordance;
use CrowdinApiClient\Model\TranslationMemoryExport;
use CrowdinApiClient\Model\TranslationMemoryImport;
use CrowdinApiClient\Model\TranslationMemorySegment;
use CrowdinApiClient\ModelCollection;

/**
 * Translation Memory (TM) is a vault of translations that were previously made in other projects.
 * Those translations can be reused to speed up the translation process.
 * Every translation made in the project is automatically added to the project Translation Memory.
 * Use API to create, upload, download, or remove specific TM.
 * Translation Memory export and import are asynchronous operations and shall be completed with sequence of API methods.
 *
 * @package Crowdin\Api
 */
class TranslationMemoryApi extends AbstractApi
{
    /**
     * List TMs
     * @link https://developer.crowdin.com/api/v2/#operation/api.tms.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.tms.getMany API Documentation Enterprise
     *
     * @param array $params
     * integer $params[userId]<br>
     * integer $params[groupId]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('tms', TranslationMemory::class, $params);
    }

    /**
     * Get TM Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.tms.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.tms.get API Documentation Enterprise
     */
    public function get(int $translationMemoryId): ?TranslationMemory
    {
        return $this->_get('tms/' . $translationMemoryId, TranslationMemory::class);
    }

    /**
     * Add TM
     * @link https://developer.crowdin.com/api/v2/#operation/api.tms.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.tms.post API Documentation Enterprise
     *
     * @param array $data
     * string $data[name]
     * @return mixed
     */
    public function create(array $data): ?TranslationMemory
    {
        return $this->_create('tms', TranslationMemory::class, $data);
    }

    /**
     * Edit TM Info
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.tms.patch API Documentation Enterprise
     */
    public function update(TranslationMemory $translationMemory): ?TranslationMemory
    {
        return $this->_update('tms/' . $translationMemory->getId(), $translationMemory);
    }

    /**
     * Delete TM
     * @link https://developer.crowdin.com/api/v2/#operation/api.tms.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.tms.delete API Documentation Enterprise
     *
     * @return null
     */
    public function delete(int $translationMemoryId)
    {
        return $this->_delete('tms/' . $translationMemoryId);
    }

    /**
     * Clear TM
     * @link https://developer.crowdin.com/api/v2/#operation/api.tms.segments.clear API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.tms.segments.clear API Documentation Enterprise
     *
     * @return null
     */
    public function clear(int $translationMemoryId)
    {
        $path = sprintf('tms/%d/segments', $translationMemoryId);
        return $this->_delete($path);
    }

    /**
     * List TM Segments
     * @link https://developer.crowdin.com/api/v2/#operation/api.tms.segments.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.tms.segments.getMany API Documentation Enterprise
     *
     * @param int $tmId
     * @param array $params
     * string $params[orderBy]<br>
     * string $params[croql]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listSegments(int $tmId, array $params = []): ModelCollection
    {
        $path = sprintf('tms/%d/segments', $tmId);
        return $this->_list($path, TranslationMemorySegment::class, $params);
    }

    /**
     * Export TM
     * @link https://developer.crowdin.com/api/v2/#operation/api.tms.exports.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.tms.exports.post API Documentation Enterprise
     *
     * @param int $translationMemoryId
     * @param array $params
     * string $params[sourceLanguageId]<br>
     * string $params[targetLanguageId]<br>
     * string $params[format]
     * @return TranslationMemoryExport|null
     */
    public function export(int $translationMemoryId, array $params = []): ?TranslationMemoryExport
    {
        $path = sprintf('tms/%d/exports', $translationMemoryId);
        return $this->_post($path, TranslationMemoryExport::class, $params);
    }

    /**
     * Check TM Export Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.tms.exports.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.tms.exports.get API Documentation Enterprise
     */
    public function checkExportStatus(int $translationMemoryId, string $exportId): ?TranslationMemoryExport
    {
        $path = sprintf('tms/%d/exports/%s', $translationMemoryId, $exportId);
        return $this->_get($path, TranslationMemoryExport::class);
    }

    /**
     * Download TM
     * @link https://developer.crowdin.com/api/v2/#operation/api.tms.exports.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.tms.exports.getMany API Documentation Enterprise
     */
    public function download(int $translationMemoryId, string $exportId): ?DownloadFile
    {
        $path = sprintf('tms/%d/exports/%s/download', $translationMemoryId, $exportId);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * Import TM
     * @link https://developer.crowdin.com/api/v2/#operation/api.tms.imports.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.tms.imports.post API Documentation Enterprise
     */
    public function import(
        int $translationMemoryId,
        int $storageId,
        bool $firstLineContainsHeader = false,
        array $scheme = []
    ): ?TranslationMemoryImport {
        $path = sprintf('tms/%d/imports', $translationMemoryId);
        $params = [
            'storageId' => $storageId,
            'firstLineContainsHeader' => $firstLineContainsHeader,
            'scheme' => $scheme,
        ];

        return $this->_create($path, TranslationMemoryImport::class, $params);
    }

    /**
     * Check TM Import Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.tms.imports.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.tms.imports.get API Documentation Enterprise
     */
    public function checkImportStatus(int $translationMemoryId, string $importId): ?TranslationMemoryImport
    {
        $path = sprintf('tms/%d/imports/%s', $translationMemoryId, $importId);
        return $this->_get($path, TranslationMemoryImport::class);
    }

    /**
     * Concordance search in TMs
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tms.concordance.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tms.concordance.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * string $params[sourceLanguageId] required<br>
     * string $params[targetLanguageId] required<br>
     * bool $params[autoSubstitution] required Improves TM suggestions<br>
     * int $params[minRelevant] required Show TM suggestions with specified minimum match (1-100)<br>
     * string[] $params[expressions] required Note: Can't be used with expression in same request<br>
     * string $params[expression] Deprecated Note: Can't be used with expressions in same request
     * @return ModelCollection|null
     */
    public function concordance(int $projectId, array $params): ?ModelCollection
    {
        return $this->client->apiRequest(
            'post',
            sprintf('projects/%d/tms/concordance', $projectId),
            new ResponseModelListDecorator(TranslationMemoryConcordance::class),
            [
                'body' => json_encode($params),
                'headers' => $this->getHeaders(),
            ]
        );
    }
}
