<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Report;
use CrowdinApiClient\Model\ReportSettingsTemplate;
use CrowdinApiClient\ModelCollection;

/**
 * Reports help to estimate costs, calculate translation costs, and identify the top members.
 * Use API to generate Cost Estimate, Translation Cost, and Top Members reports.
 * You can then export reports in .xlsx or .csv file formats.
 * Report generation is an asynchronous operation and shall be completed with a sequence of API methods.
 *
 * @package Crowdin\Api
 */
class ReportApi extends AbstractApi
{
    /**
     * Generate Report
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.reports.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.reports.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * string $data[name]<br>
     * array $data[schema]
     * @return Report|null
     */
    public function generate(int $projectId, array $data): ?Report
    {
        $path = sprintf('projects/%s/reports', $projectId);
        return $this->_post($path, Report::class, $data);
    }

    /**
     * Check Report Generation Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.reports.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.reports.get API Documentation Enterprise
     */
    public function get(int $projectId, string $reportId): ?Report
    {
        $path = sprintf('projects/%d/reports/%s', $projectId, $reportId);
        return $this->_get($path, Report::class);
    }

    /**
     * Download Report
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.reports.download.download API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.reports.download.download API Documentation Enterprise
     */
    public function download(int $projectId, string $reportId): ?DownloadFile
    {
        $path = sprintf('projects/%d/reports/%s/download', $projectId, $reportId);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * List Report Settings Templates
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.reports.settings-templates.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.settings-templates.getMany API Documentation Enterprise
     */
    public function listReportSettingsTemplates(int $projectId): ModelCollection
    {
        $path = sprintf('projects/%d/reports/settings-templates', $projectId);
        return $this->_list($path, ReportSettingsTemplate::class);
    }

    /**
     * Get Report Settings Template
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.reports.settings-templates.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.settings-templates.get API Documentation Enterprise
     */
    public function getReportSettingsTemplate(int $projectId, int $reportSettingsTemplateId): ?ReportSettingsTemplate
    {
        $path = sprintf('projects/%d/reports/settings-templates/%d', $projectId, $reportSettingsTemplateId);
        return $this->_get($path, ReportSettingsTemplate::class);
    }

    /**
     * Add Report Settings Template
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.reports.settings-templates.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.settings-templates.post API Documentation Enterprise
     */
    public function createReportSettingsTemplate(int $projectId, array $data): ?ReportSettingsTemplate
    {
        $forbiddenKeys = ['id', 'createdAt', 'updatedAt'];
        $path = sprintf('projects/%d/reports/settings-templates', $projectId);

        return $this->_post(
            $path,
            ReportSettingsTemplate::class,
            array_filter($data, static function (string $key) use ($forbiddenKeys): bool {
                return !in_array($key, $forbiddenKeys, true);
            }, ARRAY_FILTER_USE_KEY)
        );
    }

    /**
     * Edit Report Settings Template
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.reports.settings-templates.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.settings-templates.patch API Documentation Enterprise
     */
    public function updateReportSettingsTemplate(
        int $projectId,
        ReportSettingsTemplate $reportSettingsTemplate
    ): ?ReportSettingsTemplate {
        $path = sprintf('projects/%d/reports/settings-templates/%d', $projectId, $reportSettingsTemplate->getId());
        return $this->_update($path, $reportSettingsTemplate);
    }

    /**
     * Delete Report Settings Template
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.reports.settings-templates.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.settings-templates.delete API Documentation Enterprise
     */
    public function deleteReportSettingsTemplate(int $projectId, int $reportSettingsTemplateId): void
    {
        $this->_delete(sprintf('projects/%d/reports/settings-templates/%d', $projectId, $reportSettingsTemplateId));
    }
}
