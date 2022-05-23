<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Http\ResponseDecorator\ResponseModelDecorator;
use CrowdinApiClient\Model\Screenshot;
use CrowdinApiClient\Model\Tag;
use CrowdinApiClient\ModelCollection;

/**
 * Screenshots provide translators with additional context for the source strings.
 * Screenshot tags allow specifying which source strings are displayed on each screenshot.
 * Use API to manage screenshots and their tags.
 *
 * @package Crowdin\Api
 */
class ScreenshotApi extends AbstractApi
{
    /**
     * List Screenshots
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.screenshots.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.screenshots.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/screenshots', $projectId);

        return $this->_list($path, Screenshot::class, $params);
    }

    /**
     * Get Screenshot
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.screenshots.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.screenshots.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $screenshotId
     * @return Screenshot|null
     */
    public function get(int $projectId, int $screenshotId): ?Screenshot
    {
        $path = sprintf('projects/%d/screenshots/%d', $projectId, $screenshotId);
        return $this->_get($path, Screenshot::class);
    }

    /**
     * Add Screenshot
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.screenshots.post API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.screenshots.post API Documentation Enterprise
     * @param int $projectId
     * @param array $data
     * integer $data[storageId] required<br>
     * string $data[name] required<br>
     * bool $data[autoTag] Automatically tags screenshot
     * @return Screenshot|null
     */
    public function create(int $projectId, array $data): ?Screenshot
    {
        $path = sprintf('projects/%d/screenshots', $projectId);
        return $this->_create($path, Screenshot::class, $data);
    }

    /**
     * Edit Screenshot
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.screenshots.patch API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.screenshots.patch API Documentation Enterprise
     * @param int $projectId
     * @param Screenshot $screenshot
     * @return Screenshot|null
     */
    public function update(int $projectId, Screenshot $screenshot): ?Screenshot
    {
        $path = sprintf('projects/%d/screenshots/%d', $projectId, $screenshot->getId());
        return $this->_update($path, $screenshot);
    }

    /**
     * Update Screenshot
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.screenshots.put API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.screenshots.put API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $screenshotId
     * @param int $storageId
     * @param string $name
     * @return Screenshot|null
     */
    public function replace(int $projectId, int $screenshotId, int $storageId, string  $name): ?Screenshot
    {
        $path = sprintf('projects/%d/screenshots/%d', $projectId, $screenshotId);
        $params = [
            'storageId' => $storageId,
            'name' => $name
        ];
        return $this->_put($path, Screenshot::class, $params);
    }

    /**
     * Delete Screenshot
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.screenshots.delete API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.screenshots.delete API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $screenshotId
     * @return mixed
     */
    public function delete(int $projectId, int $screenshotId)
    {
        $path = sprintf('projects/%d/screenshots/%d', $projectId, $screenshotId);
        return $this->_delete($path);
    }

    /**
     * List Tags
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.screenshots.tags.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.screenshots.tags.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $screenshotId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function tags(int $projectId, int $screenshotId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/screenshots/%d/tags', $projectId, $screenshotId);
        return $this->_list($path, Tag::class, $params);
    }

    /**
     * Replace Tags
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.screenshots.tags.putMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.screenshots.tags.putMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $screenshotId
     * @param array $data
     * @return mixed
     */
    public function replaceTags(int $projectId, int $screenshotId, array $data)
    {
        $path = sprintf('projects/%d/screenshots/%d/tags', $projectId, $screenshotId);

        $options = [
            'body' => json_encode($data),
            'headers' => ['Content-Type' => 'application/json']
        ];

        return $this->client->apiRequest('put', $path, null, $options);
    }

    /**
     * Add Tag
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.screenshots.tags.post API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.screenshots.tags.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $screenshotId
     * @param array $data
     * integer $data[stringId] required<br>
     * array $data[position]
     * @return Tag|null
     */
    public function addTag(int $projectId, int $screenshotId, array $data): ?Tag
    {
        $path = sprintf('projects/%d/screenshots/%d/tags', $projectId, $screenshotId);
        return $this->_create($path, Tag::class, $data);
    }

    /**
     * Clear Tags
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.screenshots.tags.deleteMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.screenshots.tags.deleteMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $screenshotId
     * @return mixed
     */
    public function clearTags(int $projectId, int $screenshotId)
    {
        $path = sprintf('projects/%d/screenshots/%d/tags', $projectId, $screenshotId);
        return $this->_delete($path);
    }

    /**
     * Get Tag
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.screenshots.tags.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.screenshots.tags.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $screenshotId
     * @param int $tagId
     * @return Tag|null
     */
    public function getTag(int $projectId, int $screenshotId, int $tagId): ?Tag
    {
        $path = sprintf('projects/%d/screenshots/%d/tags/%d', $projectId, $screenshotId, $tagId);
        return  $this->_get($path, Tag::class);
    }

    /**
     * Delete Tag
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.screenshots.tags.delete API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.screenshots.tags.delete API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $screenshotId
     * @param int $tagId
     * @return mixed
     */
    public function deleteTag(int $projectId, int $screenshotId, int $tagId)
    {
        $path = sprintf('projects/%d/screenshots/%d/tags/%d', $projectId, $screenshotId, $tagId);
        return  $this->_delete($path);
    }

    /**
     * Edit Tag
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.screenshots.tags.patch API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.screenshots.tags.patch API Documentation Enterprise
     *
     * @param int $projectId
     * @param Tag $tag
     * @return mixed
     */
    public function updateTag(int $projectId, Tag $tag): ?Screenshot
    {
        $path = sprintf('projects/%d/screenshots/%d/tags/%d', $projectId, $tag->getScreenshotId(), $tag->getId());

        $dataModel = $tag->getProperties();

        $_data = [];

        foreach ($tag->getData() as $key => $val) {
            if (isset($dataModel[$key]) && $dataModel[$key] != $val) {
                $_data[] = [
                    'op' => 'replace',
                    'path' => '/' . $key,
                    'value' => $dataModel[$key]
                ];
            }
        }

        if (empty($_data)) {
            return $tag;
        }

        $options = [
            'body' => json_encode($_data),
            'headers' => ['Content-Type' => 'application/json']
        ];

        return $this->client->apiRequest('patch', $path, new ResponseModelDecorator(Screenshot::class), $options);
    }
}
