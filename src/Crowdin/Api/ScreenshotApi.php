<?php

namespace Crowdin\Api;

use Crowdin\Model\Screenshot;
use Crowdin\Model\Tag;

/**
 * Class ScreenshotApi
 * @package Crowdin\Api
 */
class ScreenshotApi extends AbstractApi
{
    /**
     * @param int $projectId
     * @return mixed
     */
    public function list(int $projectId)
    {
        $path = sprintf('projects/%d/screenshots', $projectId);

        return $this->_list($path, Screenshot::class);
    }

    /**
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
     * @param int $projectId
     * @param array $data
     * @return Screenshot|null
     */
    public function create(int $projectId, array $data): ?Screenshot
    {
        $path = sprintf('projects/%d/screenshots', $projectId);
        return $this->_create($path, Screenshot::class, $data);
    }

    /**
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
     * @param int $projectId
     * @param int $screenshotId
     * @return mixed
     */
    public function listTags(int $projectId, int $screenshotId)
    {
        $path = sprintf('projects/%d/screenshots/%d/tags', $projectId, $screenshotId);
        return $this->_list($path, Tag::class);
    }

    /**
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
     * @param int $projectId
     * @param int $screenshotId
     * @param array $data
     * @return Tag|null
     */
    public function addTag(int $projectId, int $screenshotId, array $data):?Tag
    {
        $path = sprintf('projects/%d/screenshots/%d/tags', $projectId, $screenshotId);
        return $this->_create($path, Tag::class, $data);
    }

    /**
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
     * @param int $projectId
     * @param int $screenshotId
     * @param int $tagId
     * @return Tag|null
     */
    public function getTag(int $projectId, int $screenshotId, int $tagId):?Tag
    {
        $path = sprintf('projects/%d/screenshots/%d/tags/%d', $projectId, $screenshotId, $tagId);
        return  $this->_get($path, Tag::class);
    }

    /**
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
     * @param int $projectId
     * @param Tag $tag
     * @return mixed
     */
    public function updateTag(int $projectId, Tag $tag):?Screenshot
    {
        $path = sprintf('projects/%d/screenshots/%d/tags/%d', $projectId, $tag->getScreenshotId(), $tag->getId());
        return  $this->_update($path, $tag);
    }
}
