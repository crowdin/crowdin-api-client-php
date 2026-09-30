<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\CustomPlaceholder;
use CrowdinApiClient\Model\Enterprise\ProjectPlaceholder;
use CrowdinApiClient\ModelCollection;

/**
 * Custom placeholders are defined once for the organization and then assigned to projects.
 *
 * @package Crowdin\Api\Enterprise
 */
class CustomPlaceholderApi extends AbstractApi
{
    /**
     * List Custom Placeholders
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.custom-placeholders.getMany API Documentation
     *
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('custom-placeholders', CustomPlaceholder::class, $params);
    }

    /**
     * Add Custom Placeholder
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.custom-placeholders.post API Documentation
     *
     * @param array $data
     * string $data[definition] required<br>
     * string $data[description]<br>
     * string $data[argumentDelimiter] Default: "
     * @return CustomPlaceholder|null
     */
    public function create(array $data): ?CustomPlaceholder
    {
        return $this->_create('custom-placeholders', CustomPlaceholder::class, $data);
    }

    /**
     * Get Custom Placeholder
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.custom-placeholders.get API Documentation
     *
     * @param int $customPlaceholderId
     * @return CustomPlaceholder|null
     */
    public function get(int $customPlaceholderId): ?CustomPlaceholder
    {
        return $this->_get('custom-placeholders/' . $customPlaceholderId, CustomPlaceholder::class);
    }

    /**
     * Edit Custom Placeholder
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.custom-placeholders.patch API Documentation
     *
     * @param CustomPlaceholder $customPlaceholder
     * @return CustomPlaceholder|null
     */
    public function update(CustomPlaceholder $customPlaceholder): ?CustomPlaceholder
    {
        return $this->_update('custom-placeholders/' . $customPlaceholder->getId(), $customPlaceholder);
    }

    /**
     * Delete Custom Placeholder
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.custom-placeholders.delete API Documentation
     *
     * @param int $customPlaceholderId
     * @return mixed
     */
    public function delete(int $customPlaceholderId)
    {
        return $this->_delete('custom-placeholders/' . $customPlaceholderId);
    }

    /**
     * List Project Placeholders
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.placeholders.getMany API Documentation
     *
     * @param int $projectId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listProjectPlaceholders(int $projectId, array $params = []): ModelCollection
    {
        return $this->_list(sprintf('projects/%d/placeholders', $projectId), ProjectPlaceholder::class, $params);
    }

    /**
     * Add Project Placeholder
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.placeholders.post API Documentation
     *
     * @param int $projectId
     * @param array $data
     * integer $data[customPlaceholderId] required<br>
     * string $data[type] Enum: "high" "low"<br>
     * integer $data[index]<br>
     * boolean $data[isBlocking]<br>
     * string[] $data[formats] Empty means every file format
     * @return ProjectPlaceholder|null
     */
    public function addProjectPlaceholder(int $projectId, array $data): ?ProjectPlaceholder
    {
        return $this->_create(sprintf('projects/%d/placeholders', $projectId), ProjectPlaceholder::class, $data);
    }

    /**
     * Get Project Placeholder
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.placeholders.get API Documentation
     *
     * @param int $projectId
     * @param int $projectPlaceholderId
     * @return ProjectPlaceholder|null
     */
    public function getProjectPlaceholder(int $projectId, int $projectPlaceholderId): ?ProjectPlaceholder
    {
        return $this->_get(
            sprintf('projects/%d/placeholders/%d', $projectId, $projectPlaceholderId),
            ProjectPlaceholder::class
        );
    }

    /**
     * Edit Project Placeholder
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.placeholders.patch API Documentation
     *
     * @param int $projectId
     * @param ProjectPlaceholder $projectPlaceholder
     * @return ProjectPlaceholder|null
     */
    public function updateProjectPlaceholder(
        int $projectId,
        ProjectPlaceholder $projectPlaceholder
    ): ?ProjectPlaceholder {
        return $this->_update(
            sprintf('projects/%d/placeholders/%d', $projectId, $projectPlaceholder->getId()),
            $projectPlaceholder
        );
    }

    /**
     * Delete Project Placeholder
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.placeholders.delete API Documentation
     *
     * @param int $projectId
     * @param int $projectPlaceholderId
     * @return mixed
     */
    public function deleteProjectPlaceholder(int $projectId, int $projectPlaceholderId)
    {
        return $this->_delete(sprintf('projects/%d/placeholders/%d', $projectId, $projectPlaceholderId));
    }
}
