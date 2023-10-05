<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\StringsExporterSetting;
use CrowdinApiClient\ModelCollection;

/**
 * Manage project strings exporter settings
 *
 * @package Crowdin\Api
 */
class StringsExporterSettingApi extends AbstractApi
{
    /**
     * List Project Strings Exporter Settings
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.strings-exporter-settings.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.strings-exporter-settings.getMany API Documentation Enterprise
     *
     * @param int $projectId
     *
     * @return ModelCollection
     */
    public function list(int $projectId): ModelCollection
    {
        $path = sprintf('projects/%d/strings-exporter-settings', $projectId);
        return $this->_list($path, StringsExporterSetting::class);
    }

    /**
     * Get Strings Exporter Settings
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.strings-exporter-settings.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.strings-exporter-settings.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $strExporterSettingsId
     * @return StringsExporterSetting|null
     */
    public function get(int $projectId, int $strExporterSettingsId): ?StringsExporterSetting
    {
        $path = sprintf('projects/%d/strings-exporter-settings/%d', $projectId, $strExporterSettingsId);
        return $this->_get($path, StringsExporterSetting::class);
    }

    /**
     * Add Strings Exporter Settings
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.strings-exporter-settings.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.strings-exporter-settings.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * string $data[format] required Enum: "android" "macosx" "xliff"
     * array $data[settings] required
     * @return StringsExporterSetting|null
     */
    public function create(int $projectId, array $data): ?StringsExporterSetting
    {
        $path = sprintf('projects/%d/strings-exporter-settings', $projectId);
        return $this->_create($path, StringsExporterSetting::class, $data);
    }

    /**
     * Edit Strings Exporter Settings
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.strings-exporter-settings.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.strings-exporter-settings.patch API Documentation Enterprise
     *
     * @param int $projectId
     * @param StringsExporterSetting $stringsExporterSetting
     *
     * @return StringsExporterSetting|null
     */
    public function update(int $projectId, StringsExporterSetting $stringsExporterSetting): ?StringsExporterSetting
    {
        $path = sprintf('projects/%d/strings-exporter-settings/%d', $projectId, $stringsExporterSetting->getId());

        return $this->_update($path, $stringsExporterSetting);
    }

    /**
     * Delete Strings Exporter Settings
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.strings-exporter-settings.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.strings-exporter-settings.delete API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $strExporterSettingsId
     * @return mixed
     */
    public function delete(int $projectId, int $strExporterSettingsId)
    {
        $path = sprintf('projects/%d/strings-exporter-settings/%d', $projectId, $strExporterSettingsId);
        return $this->_delete($path);
    }
}
