<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\FileFormatSettings;
use CrowdinApiClient\Model\Project;
use CrowdinApiClient\ModelCollection;

/**
 * Using projects, you can keep your source files sorted.
 * Use API to manage projects, change their settings, or remove them if required.
 *
 * @package Crowdin\Api
 */
class ProjectApi extends AbstractApi
{
    /**
     * List Projects
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.getMany API Documentation Enterprise
     *
     * @param array $params
     * integer $params[groupId] for enterprise only<br>
     * integer $params[hasManagerAccess] for enterprise only Enum{0,1} (0 -false, 1 true)<br>
     * integer $params[limit]<br>
     * integer $params[offset]<br>
     * integer $params[userId] Get user own projects
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('projects', Project::class, $params);
    }

    /**
     * Get Project Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.get API Documentation Enterprise
     */
    public function get(int $projectId): ?Project
    {
        return $this->_get('projects/' . $projectId, Project::class);
    }

    /**
     * Add Project
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.post API Documentation Enterprise
     *
     * @param array $data
     * string $data[name] required<br>
     * string $data[identifier]<br>
     * string $data[type]<br>
     * string $data[sourceLanguageId] required<br>
     * integer $data[groupId] required<br>
     * integer $data[templateId] required<br>
     * integer $data[groupId]<br>
     * array $data[targetLanguageIds]<br>
     * string $data[visibility]<br>
     * string $data[languageAccessPolicy]<br>
     * string $data[cname]<br>
     * integer $data[vendorId]<br>
     * integer $data[mtEngineId]<br>
     * string $data[description]<br>
     * boolean $data[delayedWorkflowStart]<br>
     * boolean $data[skipUntranslatedStrings]<br>
     * boolean $data[skipUntranslatedFiles]<br>
     * integer $data[exportWithMinApprovalsCount]<br>
     * integer $data[exportApprovedOnly]
     * @return Project|null
     */
    public function create(array $data): ?Project
    {
        return $this->_create('projects', Project::class, $data);
    }

    /**
     * Edit Project Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.patch API Documentation Enterprise
     */
    public function update(Project $project): ?Project
    {
        return $this->_update('projects/' . $project->getId(), $project);
    }

    /**
     * Delete Project
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.delete API Documentation Enterprise
     *
     * @param int $projectId
     * @return mixed
     */
    public function delete(int $projectId)
    {
        return $this->client->apiRequest('delete', 'projects/' . $projectId);
    }

    /**
     * Download Project File Format Settings Custom Segmentation
     * @link https://support.crowdin.com/developer/api/v2/#tag/Projects/operation/api.projects.file-format-settings.custom-segmentations.get
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/Projects-and-Groups/operation/api.projects.file-format-settings.custom-segmentations.get
     */
    public function downloadFileFormatSettingsCustomSegmentation(
        int $projectId,
        int $fileFormatSettingsId
    ): ?DownloadFile {
        $path = sprintf('projects/%d/file-format-settings/%d/custom-segmentations', $projectId, $fileFormatSettingsId);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * Reset Project File Format Settings Custom Segmentation
     * @link https://support.crowdin.com/developer/api/v2/#tag/Projects/operation/api.projects.file-format-settings.custom-segmentations.delete
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/Projects-and-Groups/operation/api.projects.file-format-settings.custom-segmentations.delete
     */
    public function resetFileFormatSettingsCustomSegmentation(int $projectId, int $fileFormatSettingsId): void
    {
        $this->_delete(
            sprintf('projects/%d/file-format-settings/%d/custom-segmentations', $projectId, $fileFormatSettingsId)
        );
    }

    /**
     * List Project File Format Settings
     * @link https://support.crowdin.com/developer/api/v2/#tag/Projects/operation/api.projects.file-format-settings.getMany
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/Projects-and-Groups/operation/api.projects.file-format-settings.getMany
     */
    public function listFileFormatSettings(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/file-format-settings', $projectId);
        return $this->_list($path, FileFormatSettings::class, $params);
    }

    /**
     * Add Project File Format Settings
     * @link https://support.crowdin.com/developer/api/v2/#tag/Projects/operation/api.projects.file-format-settings.post
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/Projects-and-Groups/operation/api.projects.file-format-settings.post
     */
    public function createFileFormatSettings(int $projectId, array $data): ?FileFormatSettings
    {
        $path = sprintf('projects/%d/file-format-settings', $projectId);
        return $this->_create($path, FileFormatSettings::class, $data);
    }

    /**
     * Get Project File Format Settings
     * @link https://support.crowdin.com/developer/api/v2/#tag/Projects/operation/api.projects.file-format-settings.get
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/Projects-and-Groups/operation/api.projects.file-format-settings.get
     */
    public function getFileFormatSettings(int $projectId, int $fileFormatSettingsId): ?FileFormatSettings
    {
        $path = sprintf('projects/%d/file-format-settings/%d', $projectId, $fileFormatSettingsId);
        return $this->_get($path, FileFormatSettings::class);
    }

    /**
     * Delete Project File Format Settings
     * @link https://support.crowdin.com/developer/api/v2/#tag/Projects/operation/api.projects.file-format-settings.delete
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/Projects-and-Groups/operation/api.projects.file-format-settings.delete
     */
    public function deleteFileFormatSettings(int $projectId, int $fileFormatSettingsId): void
    {
        $this->_delete(sprintf('projects/%d/file-format-settings/%d', $projectId, $fileFormatSettingsId));
    }

    /**
     * Edit Project File Format Settings
     * @link https://support.crowdin.com/developer/api/v2/#tag/Projects/operation/api.projects.file-format-settings.patch
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/Projects-and-Groups/operation/api.projects.file-format-settings.patch
     */
    public function updateFileFormatSettings(
        int $projectId,
        FileFormatSettings $fileFormatSettings
    ): ?FileFormatSettings {
        $path = sprintf('projects/%d/file-format-settings/%d', $projectId, $fileFormatSettings->getId());
        return $this->_update($path, $fileFormatSettings);
    }
}
