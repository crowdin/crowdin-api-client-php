<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\ApplicationData;

/**
 * Use API to manage custom application data.
 *
 * @package Crowdin\Api
 */
class ApplicationApi extends AbstractApi
{
    /**
     * Get Application Data
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.api.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.api.get API Documentation Enterprise
     *
     * @param string $applicationIdentifier
     * @param string $path
     * @param array $params
     * @return ApplicationData|null
     */
    public function getApplicationData(string $applicationIdentifier, string $path, array $params = []): ?ApplicationData
    {
        $url = sprintf('applications/%s/api/%s', $applicationIdentifier, $path);
        return $this->_get($url, ApplicationData::class, $params);
    }

    /**
     * Add Application Data
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.api.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.api.post API Documentation Enterprise
     *
     * @param string $applicationIdentifier
     * @param string $path
     * @param array $data
     * @return ApplicationData|null
     */
    public function addApplicationData(string $applicationIdentifier, string $path, array $data): ?ApplicationData
    {
        $url = sprintf('applications/%s/api/%s', $applicationIdentifier, $path);
        return $this->_post($url, ApplicationData::class, $data);
    }

    /**
     * Update or Restore Application Data
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.api.put API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.api.put API Documentation Enterprise
     *
     * @param string $applicationIdentifier
     * @param string $path
     * @param array $data
     * @return ApplicationData|null
     */
    public function updateOrRestoreApplicationData(string $applicationIdentifier, string $path, array $data): ?ApplicationData
    {
        $url = sprintf('applications/%s/api/%s', $applicationIdentifier, $path);
        return $this->_put($url, ApplicationData::class, $data);
    }

    /**
     * Delete Application Data
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.api.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.api.delete API Documentation Enterprise
     *
     * @param string $applicationIdentifier
     * @param string $path
     * @return mixed
     */
    public function deleteApplicationData(string $applicationIdentifier, string $path)
    {
        $url = sprintf('applications/%s/api/%s', $applicationIdentifier, $path);
        return $this->_delete($url);
    }

    /**
     * Edit Application Data
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.api.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.api.patch API Documentation Enterprise
     *
     * @param string $applicationIdentifier
     * @param string $path
     * @param array $data
     * @return ApplicationData|null
     */
    public function editApplicationData(string $applicationIdentifier, string $path, array $data): ?ApplicationData
    {
        $url = sprintf('applications/%s/api/%s', $applicationIdentifier, $path);
        return $this->_patch($url, ApplicationData::class, $data);
    }
}
