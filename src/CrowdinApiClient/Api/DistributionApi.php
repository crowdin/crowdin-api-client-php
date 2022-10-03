<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Distribution;
use CrowdinApiClient\Model\DistributionRelease;
use CrowdinApiClient\ModelCollection;

/**
 * Distribution is a CDN vault that mirrors your project’s translated content and is required for integration with the iOS, Android, or Web apps.
 *
 * @package Crowdin\Api
 */
class DistributionApi extends AbstractApi
{
    /**
     * List Distributions
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.distributions.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.distributions.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[limit]  [ 1 .. 500 ] Default: 25<br>
     * integer $params[offset]  >= 0 Default: 0
     *
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/distributions', $projectId);
        return $this->_list($path, Distribution::class, $params);
    }

    /**
     * Get Distribution
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.distributions.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.distributions.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param string $hash
     * @return Distribution|null
     */
    public function get(int $projectId, string $hash): ?Distribution
    {
        $path = sprintf('projects/%d/distributions/%s', $projectId, $hash);
        return $this->_get($path, Distribution::class);
    }

    /**
     * Add Distribution
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.distributions.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.distributions.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * @return Distribution|null
     */
    public function create(int $projectId, array $data): ?Distribution
    {
        $path = sprintf('projects/%d/distributions', $projectId);
        return $this->_create($path, Distribution::class, $data);
    }

    /**
     * Edit Distribution
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.distributions.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.distributions.patch API Documentation Enterprise
     *
     * @param int $projectId
     * @param Distribution $distribution
     * @return Distribution|null
     */
    public function update(int $projectId, Distribution $distribution): ?Distribution
    {
        $path = sprintf('projects/%d/distributions/%s', $projectId, $distribution->getHash());
        return $this->_update($path, $distribution);
    }

    /**
     * Delete Distribution
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.distributions.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.distributions.delete API Documentation Enterprise
     *
     * @param int $projectId
     * @param string $hash
     */
    public function delete(int $projectId, string $hash)
    {
        $path = sprintf('projects/%d/distributions/%s', $projectId, $hash);
        $this->_delete($path);
    }

    /**
     * Release Distribution
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.distributions.release.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.distributions.release.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param string $hash
     * @return DistributionRelease|null
     */
    public function release(int $projectId, string $hash): ?DistributionRelease
    {
        $path = sprintf('projects/%d/distributions/%s/release', $projectId, $hash);

        return $this->_create($path, DistributionRelease::class, []);
    }

    /**
     * Get Distribution Release
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.distributions.release.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.distributions.release.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param string $hash
     * @return DistributionRelease|null
     */
    public function getRelease(int $projectId, string $hash): ?DistributionRelease
    {
        $path = sprintf('projects/%d/distributions/%s/release', $projectId, $hash);

        return $this->_get($path, DistributionRelease::class);
    }
}
