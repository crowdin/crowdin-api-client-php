<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Model\Report;

/**
 * Class ReportApi
 * @package Crowdin\Api
 */
class ReportApi extends \CrowdinApiClient\Api\ReportApi
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
}
