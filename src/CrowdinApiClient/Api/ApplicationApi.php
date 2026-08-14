<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\ApplicationData;
use CrowdinApiClient\Model\ApplicationInstallation;
use CrowdinApiClient\ModelCollection;

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
     * List Application Installations
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.installations.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.installations.getMany API Documentation Enterprise
     *
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]<br>
     * integer $params[installedBy]<br>
     * string $params[orderBy]
     * @return ModelCollection
     */
    public function listInstallations(array $params = []): ModelCollection
    {
        return $this->_list('applications/installations', ApplicationInstallation::class, $params);
    }

    /**
     * Install Application
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.installations.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.installations.post API Documentation Enterprise
     *
     * @param array $data
     * string $data[url] required<br>
     * array $data[permissions]<br>
     * array $data[modules]<br>
     * bool $data[assignAgent]
     * @return ApplicationInstallation|null
     */
    public function installApplication(array $data): ?ApplicationInstallation
    {
        return $this->_create('applications/installations', ApplicationInstallation::class, $data);
    }

    /**
     * Get Application Installation
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.installations.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.installations.get API Documentation Enterprise
     *
     * @param string $identifier
     * @return ApplicationInstallation|null
     */
    public function getInstallation(string $identifier): ?ApplicationInstallation
    {
        return $this->_get('applications/installations/' . $identifier, ApplicationInstallation::class);
    }

    /**
     * Delete Application Installation
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.installations.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.installations.delete API Documentation Enterprise
     *
     * @param string $identifier
     * @param bool $force
     * @return mixed
     */
    public function deleteInstallation(string $identifier, bool $force = false)
    {
        $params = $force ? ['force' => true] : [];
        return $this->_delete('applications/installations/' . $identifier, $params);
    }

    /**
     * Edit Application Installation
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.installations.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.installations.patch API Documentation Enterprise
     *
     * @param ApplicationInstallation $installation
     * @return ApplicationInstallation|null
     */
    public function updateInstallation(ApplicationInstallation $installation): ?ApplicationInstallation
    {
        return $this->_update('applications/installations/' . $installation->getIdentifier(), $installation);
    }

    /**
     * Edit Application Data
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.api.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.api.patch API Documentation Enterprise
     *
     * @param string $applicationIdentifier
     * @param string $path
     * @param array $data Application-specific key-value payload (free-form, not RFC 6902 patch operations)
     * @return ApplicationData|null
     */
    public function editApplicationData(string $applicationIdentifier, string $path, array $data): ?ApplicationData
    {
        $url = sprintf('applications/%s/api/%s', $applicationIdentifier, $path);
        return $this->_patch($url, ApplicationData::class, $data);
    }
}
