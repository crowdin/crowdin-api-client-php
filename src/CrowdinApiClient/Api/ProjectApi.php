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
     * integer $params[groupId] Enterprise only<br>
     * integer $params[hasManagerAccess] Enterprise only. Enum: 0 - false, 1 - true<br>
     * integer $params[limit]<br>
     * integer $params[offset]<br>
     * integer $params[userId] Get user own projects<br>
     * string $params[orderBy]<br>
     * string $params[filter]<br>
     * integer $params[type] Crowdin only
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
     * integer $data[exportApprovedOnly]<br>
     * integer $data[defaultTmId]<br>
     * integer $data[defaultGlossaryId]<br>
     * array $data[externalQaChecksIgnorable] Enterprise only. External QA check IDs mapped to bool, e.g. [1 => false]<br>
     * integer $data[tagsDetection] Enum: 0 - Auto; 1 - Count tags; 2 - Skip tags<br>
     * boolean $data[isMtAllowed]<br>
     * boolean $data[taskBasedAccessControl]<br>
     * boolean $data[autoSubstitution]<br>
     * boolean $data[autoTranslateDialects]<br>
     * boolean $data[publicDownloads]<br>
     * boolean $data[hiddenStringsProofreadersAccess]<br>
     * boolean $data[useGlobalTm] Crowdin only<br>
     * boolean $data[showTmSuggestionsDialects]<br>
     * boolean $data[tmApprovedSuggestionsOnly]<br>
     * boolean $data[qaCheckIsActive]<br>
     * array $data[qaCheckCategories]<br>
     * array $data[qaChecksIgnorableCategories]<br>
     * array $data[languageMapping]<br>
     * string $data[glossaryAccessOption] Enum: "readOnly" "fullAccess" "manageDrafts"<br>
     * boolean $data[normalizePlaceholder]<br>
     * array $data[notificationSettings]<br>
     * array $data[tmPreTranslate] Crowdin only<br>
     * array $data[mtPreTranslate] Crowdin only<br>
     * array $data[aiPreTranslate] Crowdin only<br>
     * integer $data[editorSuggestionAiPromptId]<br>
     * integer $data[qaCheckActionAiPromptId]<br>
     * integer $data[contextReviewAiPromptId]<br>
     * integer $data[savingsReportSettingsTemplateId]<br>
     * array $data[assignedStyleGuides]<br>
     * boolean $data[inContext]<br>
     * boolean $data[inContextProcessHiddenStrings]<br>
     * string $data[inContextPseudoLanguageId]<br>
     * boolean $data[saveMetaInfoInSource]<br>
     * string $data[tmContextType] Enum: "segmentContext" "auto" "prevAndNextSegment"<br>
     * array $data[steps] Enterprise only<br>
     * integer $data[translateDuplicates] Enterprise only. Enum: 0 - Show; 1 - Hide; 2 - Show, but auto-translate;
     * 3 - Show within a version branch; 4 - Hide (strict); 5 - Show within a version branch (strict)<br>
     * array $data[taskReviewerIds] Enterprise only<br>
     * boolean $data[exportStringsThatPassedWorkflow] Enterprise only<br>
     * integer $data[qaApprovalsCount] Enterprise only<br>
     * array $data[customQaCheckIds] Enterprise only<br>
     * array $data[externalQaCheckIds] Enterprise only<br>
     * array $data[fields] Enterprise only<br>
     * integer $data[alignmentActionAiPromptId] Enterprise only
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
     *
     * @param int $projectId
     * @param array $data
     * string $data[format] required<br>
     * array $data[settings] required
     * @return FileFormatSettings|null
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
