<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\DownloadFile;
use CrowdinApiClient\Model\Enterprise\Report;

/**
 * Class ReportApi
 * @package Crowdin\Api
 */
class ReportApi extends AbstractApi
{
    /**
     * @param int $projectId
     * @param array $data
     * @return Report|null
     */
    public function generate(int $projectId, array $data): ?Report
    {
        $path = sprintf('projects/%s/reports', $projectId);
        return $this->_post($path, Report::class, $data);
    }

    /**
     * @param int $projectId
     * @param string $reportId
     * @return Report|null
     */
    public function get(int $projectId, string $reportId): ?Report
    {
        $path = sprintf('projects/%d/reports/%s', $projectId, $reportId);
        return $this->_get($path, Report::class);
    }

    /**
     * @param int $projectId
     * @param string $reportId
     * @return DownloadFile|null
     */
    public function download(int $projectId, string $reportId): ?DownloadFile
    {
        $path = sprintf('projects/%d/reports/%s/download', $projectId, $reportId);
        return $this->_get($path, DownloadFile::class);
    }
}
