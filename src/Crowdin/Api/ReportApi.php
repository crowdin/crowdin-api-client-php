<?php

namespace Crowdin\Api;

use Crowdin\Model\DownloadFile;
use Crowdin\Model\Report;

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
     * @param int $reportId
     * @return DownloadFile|null
     */
    public function download(int $projectId, int $reportId): ?DownloadFile
    {
        $path = sprintf('projects/%d/reports/%d/download', $projectId, $reportId);
        return $this->_get($path, DownloadFile::class);
    }
}
