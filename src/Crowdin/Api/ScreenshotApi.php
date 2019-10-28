<?php


namespace Crowdin\Api;

use Crowdin\Api\Traits\GrudTrait;
use Crowdin\Model\Screenshot;

/**
 * Class ScreenshotApi
 * @package Crowdin\Api
 */
class ScreenshotApi extends AbstractApi
{
    use GrudTrait;

    /**
     * @param int $projectId
     * @return mixed
     */
    public function list(int $projectId)
    {
        $path = sprintf('/projects/%d/screenshots', $projectId);

        return $this->_list($path, Screenshot::class);
    }

    /**
     * @param int $projectId
     * @param int $screenshotId
     * @return Screenshot|null
     */
    public function get(int $projectId, int $screenshotId):?Screenshot
    {
        $path = sprintf('/projects/%d/screenshots/%d', $projectId, $screenshotId);
        return $this->_get($path, Screenshot::class);
    }

    /**
     * @param int $projectId
     * @param array $data
     * @return Screenshot|null
     */
    public function create(int $projectId, array $data):?Screenshot
    {
        $path = sprintf('/projects/%d/screenshots', $projectId);
        return $this->_create($path, Screenshot::class, $data);
    }

    public function update()
    {
        //TODO
    }

    /**
     * @param int $projectId
     * @param int $screenshotId
     * @return mixed
     */
    public function delete(int $projectId, int $screenshotId)
    {
        $path = sprintf('/projects/%d/screenshots/%d', $projectId, $screenshotId);
        return $this->_delete($path);
    }
}
