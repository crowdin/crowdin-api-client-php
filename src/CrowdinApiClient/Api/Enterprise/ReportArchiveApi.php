<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\ReportArchive;
use CrowdinApiClient\Model\ReportArchiveExport;
use CrowdinApiClient\ModelCollection;

class ReportArchiveApi extends AbstractApi
{
    /**
     * List Report Archives
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.archives.getMany
     *
     * @param array $params
     * string $params[scopeType]
     * integer $params[scopeId]
     * integer $params[limit]
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        $path = 'reports/archives';
        return $this->_list($path, ReportArchive::class, $params);
    }

    /**
     * Get Report Archive
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.archives.get
     *
     * @param int $archiveId
     * @return ReportArchive|null
     */
    public function get(int $archiveId): ?ReportArchive
    {
        $path = sprintf('reports/archives/%d', $archiveId);
        return $this->_get($path, ReportArchive::class);
    }

    /**
     * Delete Report Archive
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.archives.delete
     *
     * @param int $archiveId
     * @return void
     */
    public function delete(int $archiveId): void
    {
        $path = sprintf('reports/archives/%d', $archiveId);
        $this->_delete($path);
    }

    /**
     * Export Report Archive
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.archives.exports.post
     *
     * @param int $archiveId
     * @param array $params
     * string $params[format] Enum: "xlsx" "csv" "json"
     * @return ReportArchiveExport|null
     */
    public function export(int $archiveId, array $params = []): ?ReportArchiveExport
    {
        $path = sprintf('reports/archives/%d/exports', $archiveId);
        return $this->_post($path, ReportArchiveExport::class, $params);
    }

    /**
     * Check Report Archive Export Status
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.archives.exports.get
     *
     * @param int $archiveId
     * @param string $exportId
     * @return ReportArchiveExport|null
     */
    public function checkExportStatus(int $archiveId, string $exportId): ?ReportArchiveExport
    {
        $path = sprintf('reports/archives/%d/exports/%s', $archiveId, $exportId);
        return $this->_get($path, ReportArchiveExport::class);
    }

    /**
     * Download Report Archive
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.archives.exports.download.get
     *
     * @param int $archiveId
     * @param string $exportId
     * @return DownloadFile|null
     */
    public function downloadReportArchive(int $archiveId, string $exportId): ?DownloadFile
    {
        $path = sprintf('reports/archives/%d/exports/%s/download', $archiveId, $exportId);
        return $this->_get($path, DownloadFile::class);
    }
}
