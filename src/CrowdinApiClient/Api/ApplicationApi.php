<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\ApplicationConsent;
use CrowdinApiClient\Model\ApplicationData;
use CrowdinApiClient\Model\ApplicationInstallation;
use CrowdinApiClient\Model\ApplicationInstallationUpdate;
use CrowdinApiClient\Model\ApplicationKvRecord;
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
     * List Application Consents
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.consents.getMany API Documentation
     *
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]<br>
     * string $params[identifier]<br>
     * string $params[orderBy]
     * @return ModelCollection
     */
    public function listConsents(array $params = []): ModelCollection
    {
        return $this->_list('applications/consents', ApplicationConsent::class, $params);
    }

    /**
     * Add Application Consent
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.consents.post API Documentation
     *
     * @param array $data
     * string $data[identifier] required<br>
     * integer $data[installedBy] required<br>
     * string $data[status] required<br>
     * array $data[scopes]
     * @return ApplicationConsent|null
     */
    public function addConsent(array $data): ?ApplicationConsent
    {
        return $this->_create('applications/consents', ApplicationConsent::class, $data);
    }

    /**
     * Edit Application Consent
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.consents.patch API Documentation
     *
     * @param ApplicationConsent $consent
     * @return ApplicationConsent|null
     */
    public function updateConsent(ApplicationConsent $consent): ?ApplicationConsent
    {
        return $this->_update('applications/consents/' . $consent->getId(), $consent);
    }

    /**
     * Delete Application Consent
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.consents.delete API Documentation
     *
     * @param int $consentId
     * @return mixed
     */
    public function deleteConsent(int $consentId)
    {
        return $this->_delete('applications/consents/' . $consentId);
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

    /**
     * Upload Application Installation Bundle
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.installations.bundles.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.installations.bundles.post API Documentation Enterprise
     *
     * @param string $identifier
     * @param array $data
     * integer $data[storageId] required. ZIP archive with a non-empty app.js at its root
     * @return ApplicationInstallation|null
     */
    public function uploadInstallationBundle(string $identifier, array $data): ?ApplicationInstallation
    {
        return $this->_post(
            sprintf('applications/installations/%s/bundles', $identifier),
            ApplicationInstallation::class,
            $data
        );
    }

    /**
     * Get Application Installation Update
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.installations.update.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.installations.update.get API Documentation Enterprise
     *
     * @param string $identifier
     * @return ApplicationInstallationUpdate|null
     */
    public function getInstallationUpdate(string $identifier): ?ApplicationInstallationUpdate
    {
        return $this->_get(
            sprintf('applications/installations/%s/update', $identifier),
            ApplicationInstallationUpdate::class
        );
    }

    /**
     * Apply Application Installation Update
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.installations.update.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.installations.update.post API Documentation Enterprise
     *
     * @param string $identifier
     * @param array $data
     * string $data[manifestHash] required. From getInstallationUpdate()
     * @return ApplicationInstallation|null
     */
    public function applyInstallationUpdate(string $identifier, array $data): ?ApplicationInstallation
    {
        return $this->_post(
            sprintf('applications/installations/%s/update', $identifier),
            ApplicationInstallation::class,
            $data
        );
    }

    /**
     * List Application KV Records
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.storage.kv.records.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.storage.kv.records.getMany API Documentation Enterprise
     * Note: requires the application's own access token, personal access tokens are not supported.
     *
     * @param string $applicationIdentifier
     * @param array $params
     * string $params[prefix]<br>
     * string $params[orderBy]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listKvRecords(string $applicationIdentifier, array $params = []): ModelCollection
    {
        return $this->_list(
            sprintf('applications/%s/storage/kv/records', $applicationIdentifier),
            ApplicationKvRecord::class,
            $params
        );
    }

    /**
     * Add Application KV Record
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.storage.kv.records.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.storage.kv.records.post API Documentation Enterprise
     * Note: requires the application's own access token, personal access tokens are not supported.
     *
     * @param string $applicationIdentifier
     * @param array $data
     * string $data[key] required<br>
     * mixed $data[value] required. Any JSON value except null<br>
     * boolean $data[secret]<br>
     * integer $data[ttl] Time to live in seconds (60-31536000)
     * @return ApplicationKvRecord|null
     */
    public function addKvRecord(string $applicationIdentifier, array $data): ?ApplicationKvRecord
    {
        return $this->_create(
            sprintf('applications/%s/storage/kv/records', $applicationIdentifier),
            ApplicationKvRecord::class,
            $data
        );
    }

    /**
     * Get Application KV Record
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.storage.kv.records.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.storage.kv.records.get API Documentation Enterprise
     * Note: requires the application's own access token, personal access tokens are not supported.
     *
     * @param string $applicationIdentifier
     * @param string $key
     * @return ApplicationKvRecord|null
     */
    public function getKvRecord(string $applicationIdentifier, string $key): ?ApplicationKvRecord
    {
        return $this->_get(
            sprintf('applications/%s/storage/kv/records/%s', $applicationIdentifier, $key),
            ApplicationKvRecord::class
        );
    }

    /**
     * Edit Application KV Record
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.storage.kv.records.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.storage.kv.records.patch API Documentation Enterprise
     * Note: requires the application's own access token, personal access tokens are not supported.
     *
     * @param string $applicationIdentifier
     * @param string $key
     * @param array $data JSON Patch array. Paths: /value, /ttl (null value removes the TTL)
     * @return ApplicationKvRecord|null
     */
    public function updateKvRecord(string $applicationIdentifier, string $key, array $data): ?ApplicationKvRecord
    {
        return $this->_patch(
            sprintf('applications/%s/storage/kv/records/%s', $applicationIdentifier, $key),
            ApplicationKvRecord::class,
            $data
        );
    }

    /**
     * Delete Application KV Record
     * @link https://developer.crowdin.com/api/v2/#operation/api.applications.storage.kv.records.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.applications.storage.kv.records.delete API Documentation Enterprise
     * Note: requires the application's own access token, personal access tokens are not supported.
     *
     * @param string $applicationIdentifier
     * @param string $key
     * @return mixed
     */
    public function deleteKvRecord(string $applicationIdentifier, string $key)
    {
        return $this->_delete(sprintf('applications/%s/storage/kv/records/%s', $applicationIdentifier, $key));
    }
}
