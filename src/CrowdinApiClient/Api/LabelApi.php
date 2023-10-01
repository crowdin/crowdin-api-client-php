<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Http\ResponseDecorator\ResponseModelListDecorator;
use CrowdinApiClient\Model\Label;
use CrowdinApiClient\Model\Screenshot;
use CrowdinApiClient\ModelCollection;

/**
 * Use labels in your project for an easy way to add context to the strings or organize them by certain topics.
 *
 * @package Crowdin\Api
 */
class LabelApi extends AbstractApi
{
    /**
     * List Labels
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.labels.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.labels.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/labels', $projectId);
        return $this->_list($path, Label::class, $params);
    }

    /**
     * Get Label Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.labels.get  API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.labels.get  API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $labelId
     * @return Label|null
     */
    public function get(int $projectId, int $labelId): ?Label
    {
        $path = sprintf('projects/%d/labels/%d', $projectId, $labelId);
        return  $this->_get($path, Label::class);
    }

    /**
     * Add Label
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.labels.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.labels.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * string $data[title] required
     * @return Label|null
     */
    public function create(int $projectId, array $data): ?Label
    {
        $path = sprintf('projects/%d/labels', $projectId);
        return $this->_create($path, Label::class, $data);
    }

    /**
     * Edit Label
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.labels.patch  API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.labels.patch  API Documentation Enterprise
     *
     * @param Label $label
     * @return Label|null
     */
    public function update(Label $label): ?Label
    {
        $path = sprintf('projects/%d/labels/%d', $label->getProjectId(), $label->getId());
        return $this->_update($path, $label);
    }

    /**
     * Delete Label
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.labels.delete  API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.labels.delete  API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $labelId
     * @return mixed
     */
    public function delete(int $projectId, int $labelId)
    {
        $path = sprintf('projects/%d/labels/%d', $projectId, $labelId);
        return $this->_delete($path);
    }

    /**
     * Assign Label to Screenshots
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.labels.screenshots.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.labels.screenshots.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $labelId
     * @param array $data
     * string[] $data[screenshotIds] required
     * @return ModelCollection
     */
    public function assignScreenshots(int $projectId, int $labelId, array $data): ModelCollection
    {
        $path = sprintf('projects/%d/labels/%d/screenshots', $projectId, $labelId);

        $options = [
            'body' => json_encode($data),
            'headers' => ['Content-Type' => 'application/json']
        ];

        return $this->client->apiRequest('post', $path, new ResponseModelListDecorator(Screenshot::class), $options);
    }

    /**
     * Unassign Label from Screenshots
     *
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.labels.screenshots.deleteMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.labels.screenshots.deleteMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $labelId
     * @param array $data
     * string[] $data[screenshotIds] required
     * @return ModelCollection
     */
    public function unassignScreenshots(int $projectId, int $labelId, array $data): ModelCollection
    {
        $path = sprintf('projects/%d/labels/%d/screenshots', $projectId, $labelId);

        $options = [
            'body' => json_encode($data),
            'headers' => ['Content-Type' => 'application/json']
        ];

        return $this->client->apiRequest('delete', $path, new ResponseModelListDecorator(Screenshot::class), $options);
    }
}
