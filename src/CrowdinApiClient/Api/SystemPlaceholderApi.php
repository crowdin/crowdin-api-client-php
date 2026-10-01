<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Http\ResponseDecorator\ResponseModelListDecorator;
use CrowdinApiClient\Model\SystemPlaceholder;
use CrowdinApiClient\ModelCollection;

/**
 * Placeholders Crowdin ships and whether each one is enabled in a project.
 *
 * @package Crowdin\Api
 */
class SystemPlaceholderApi extends AbstractApi
{
    /**
     * List Project System Placeholders
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.system-placeholders.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.system-placeholders.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        return $this->_list(
            sprintf('projects/%d/system-placeholders', $projectId),
            SystemPlaceholder::class,
            $params
        );
    }

    /**
     * Project System Placeholder Batch Operations
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.system-placeholders.batchPatch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.system-placeholders.batchPatch API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data JSON Patch array. op: replace, path: /{placeholderId}/isEnabled, value: bool
     * @return ModelCollection
     */
    public function batchOperations(int $projectId, array $data): ModelCollection
    {
        return $this->client->apiRequest(
            'patch',
            sprintf('projects/%d/system-placeholders', $projectId),
            new ResponseModelListDecorator(SystemPlaceholder::class),
            [
                'body' => json_encode($data),
                'headers' => $this->getHeaders(),
            ]
        );
    }
}
