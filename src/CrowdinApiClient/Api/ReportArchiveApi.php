<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\ReportArchive;
use CrowdinApiClient\Model\ReportArchiveExport;
use CrowdinApiClient\ModelCollection;

/**
 * @package Crowdin\Api
 */
class ReportArchiveApi extends AbstractApi
{
    /**
     * List Report Archives
     * @link https://developer.crowdin.com/api/v2/#operation/api.reports.archives.getMany
     *
     * @param int $userId
     * @param array $params
     * string $params[scopeType]
     * integer $params[scopeId]
     * integer $params[limit]
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(int $userId, array $params = []): ModelCollection
    {
        $path = sprintf('users/%d/reports/archives', $userId);
        return $this->_list($path, ReportArchive::class, $params);
    }

    /**
     * Get Report Archive
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.reports.archives.get
     *
     * @param int $userId
     * @param int $archiveId
     * @return ReportArchive|null
     */
    public function get(int $userId, int $archiveId): ?ReportArchive
    {
        $path = sprintf('users/%d/reports/archives/%d', $userId, $archiveId);
        return $this->_get($path, ReportArchive::class);
    }

    /**
     * Delete Report Archive
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.reports.archives.delete
     *
     * @param int $userId
     * @param int $archiveId
     * @return void
     */
    public function delete(int $userId, int $archiveId): void
    {
        $path = sprintf('users/%d/reports/archives/%d', $userId, $archiveId);
        $this->_delete($path);
    }

    /**
     * Export Report Archive
     * @link https://developer.crowdin.com/api/v2/#operation/api.reports.archives.exports.post
     *
     * @param int $userId
     * @param int $archiveId
     * @param array $params
     * string $params[format] Enum: "xlsx" "csv" "json"
     * @return ReportArchiveExport|null
     */
    public function export(int $userId, int $archiveId, array $params = []): ?ReportArchiveExport
    {
        $path = sprintf('users/%d/reports/archives/%d/exports', $userId, $archiveId);
        return $this->_post($path, ReportArchiveExport::class, $params);
    }

    /**
     * Check Report Archive Export Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.reports.archives.exports.get
     *
     * @param int $userId
     * @param int $archiveId
     * @param string $exportId
     * @return ReportArchiveExport|null
     */
    public function checkExportStatus(int $userId, int $archiveId, string $exportId): ?ReportArchiveExport
    {
        $path = sprintf('users/%d/reports/archives/%d/exports/%s', $userId, $archiveId, $exportId);
        return $this->_get($path, ReportArchiveExport::class);
    }

    /**
     * Download Report Archive
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.reports.archives.exports.download.get
     *
     * @param int $userId
     * @param int $archiveId
     * @param string $exportId
     * @return DownloadFile|null
     */
    public function downloadReportArchive(int $userId, int $archiveId, string $exportId): ?DownloadFile
    {
        $path = sprintf('users/%d/reports/archives/%d/exports/%s/download', $userId, $archiveId, $exportId);
        return $this->_get($path, DownloadFile::class);
    }
}
