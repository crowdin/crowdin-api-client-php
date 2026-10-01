<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
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

    /**
     * Check Organization Report Generation Status
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.get API Documentation
     *
     * @param string $reportId
     * @return Report|null
     */
    public function get(string $reportId): ?Report
    {
        return $this->_get(sprintf('reports/%s', $reportId), Report::class);
    }

    /**
     * Download Organization Report
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.download.download API Documentation
     *
     * @param string $reportId
     * @return DownloadFile|null
     */
    public function download(string $reportId): ?DownloadFile
    {
        return $this->_get(sprintf('reports/%s/download', $reportId), DownloadFile::class);
    }

    /**
     * Generate Project Report
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.reports.post API Documentation
     *
     * @param int $projectId
     * @param array $data
     * string $data[name]<br>
     * array $data[schema]
     * @return Report|null
     */
    public function generateProjectReport(int $projectId, array $data): ?Report
    {
        return $this->_post(sprintf('projects/%d/reports', $projectId), Report::class, $data);
    }

    /**
     * Check Project Report Generation Status
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.reports.get API Documentation
     *
     * @param int $projectId
     * @param string $reportId
     * @return Report|null
     */
    public function getProjectReport(int $projectId, string $reportId): ?Report
    {
        return $this->_get(sprintf('projects/%d/reports/%s', $projectId, $reportId), Report::class);
    }

    /**
     * Download Project Report
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.reports.download.download API Documentation
     *
     * @param int $projectId
     * @param string $reportId
     * @return DownloadFile|null
     */
    public function downloadProjectReport(int $projectId, string $reportId): ?DownloadFile
    {
        return $this->_get(sprintf('projects/%d/reports/%s/download', $projectId, $reportId), DownloadFile::class);
    }

    /**
     * List Report Settings Templates
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.settings-templates.getMany API Documentation
     *
     * @param array $params
     * integer $params[projectId]<br>
     * integer $params[groupId]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listReportSettingsTemplates(array $params = []): ModelCollection
    {
        return $this->_list('reports/settings-templates', ReportSettingsTemplate::class, $params);
    }

    /**
     * Get Report Settings Template
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.settings-templates.get API Documentation
     *
     * @param int $reportSettingsTemplateId
     * @return ReportSettingsTemplate|null
     */
    public function getReportSettingsTemplate(int $reportSettingsTemplateId): ?ReportSettingsTemplate
    {
        return $this->_get(
            sprintf('reports/settings-templates/%d', $reportSettingsTemplateId),
            ReportSettingsTemplate::class
        );
    }

    /**
     * Add Report Settings Template
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.settings-templates.post API Documentation
     *
     * @param array $data
     * string $data[name] required<br>
     * string $data[currency] required<br>
     * string $data[unit] required<br>
     * array $data[config] required<br>
     * integer $data[projectId] Can't be used together with groupId<br>
     * integer $data[groupId] Can't be used together with projectId
     * @return ReportSettingsTemplate|null
     */
    public function createReportSettingsTemplate(array $data): ?ReportSettingsTemplate
    {
        $forbiddenKeys = ['id', 'isGlobal', 'createdAt', 'updatedAt'];

        return $this->_create(
            'reports/settings-templates',
            ReportSettingsTemplate::class,
            array_filter($data, static function ($value, string $key) use ($forbiddenKeys): bool {
                return $value !== null && !in_array($key, $forbiddenKeys, true);
            }, ARRAY_FILTER_USE_BOTH)
        );
    }

    /**
     * Edit Report Settings Template
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.settings-templates.patch API Documentation
     *
     * @param ReportSettingsTemplate $reportSettingsTemplate
     * @return ReportSettingsTemplate|null
     */
    public function updateReportSettingsTemplate(
        ReportSettingsTemplate $reportSettingsTemplate
    ): ?ReportSettingsTemplate {
        return $this->_update(
            sprintf('reports/settings-templates/%d', $reportSettingsTemplate->getId()),
            $reportSettingsTemplate
        );
    }

    /**
     * Delete Report Settings Template
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.reports.settings-templates.delete API Documentation
     *
     * @param int $reportSettingsTemplateId
     * @return mixed
     */
    public function deleteReportSettingsTemplate(int $reportSettingsTemplateId)
    {
        return $this->_delete(sprintf('reports/settings-templates/%d', $reportSettingsTemplateId));
    }
}
