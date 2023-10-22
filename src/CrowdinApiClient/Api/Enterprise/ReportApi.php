<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Report;

/**
 * Reports help to estimate costs, calculate translation costs, and identify the top members.
 * Use API to generate Cost Estimate, Translation Cost, and Top Members reports.
 * You can then export reports in .xlsx or .csv file formats.
 * Report generation is an asynchronous operation and shall be completed with a sequence of API methods.
 *
 * @package Crowdin\Api\Enterprise
 */
class ReportApi extends AbstractApi
{
    /**
     * Generate Organization Report
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.post API Documentation
     *
     * @param array $data
     * string $data[name]<br>
     * array $data[schema]
     * @return Report|null
     */
    public function generate(array $data): ?Report
    {
        return $this->_post('reports', Report::class, $data);
    }
}
