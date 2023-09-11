<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Bundle;
use CrowdinApiClient\Model\BundleExport;
use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\File;
use CrowdinApiClient\ModelCollection;

/**
 * Manage project bundles
 *
 * @package Crowdin\Api
 */
class BundleApi extends AbstractApi
{
    /**
     * List Bundles
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.bundles.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.bundles.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/bundles', $projectId);
        return $this->_list($path, Bundle::class, $params);
    }

    /**
     * Get Bundle Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.bundles.get  API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.bundles.get  API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $bundleId
     * @return Bundle|null
     */
    public function get(int $projectId, int $bundleId): ?Bundle
    {
        $path = sprintf('projects/%d/bundles/%d', $projectId, $bundleId);
        return $this->_get($path, Bundle::class);
    }

    /**
     * Add Bundle
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.bundles.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.bundles.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * string $data[name] required<br>
     * string $data[format] required<br>
     * string[] $data[sourcePatterns] required<br>
     * string[] $data[ignorePatterns]<br>
     * string $data[exportPattern] required Note: Can't contain \\ / : * ? \" < > | symbols<br>
     * int[] $data[labelIds]<br>
     * @return Bundle|null
     */
    public function create(int $projectId, array $data): ?Bundle
    {
        $path = sprintf('projects/%d/bundles', $projectId);
        return $this->_create($path, Bundle::class, $data);
    }

    /**
     * Delete Bundle
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.bundles.delete  API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.bundles.delete  API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $bundleId
     * @return mixed
     */
    public function delete(int $projectId, int $bundleId)
    {
        $path = sprintf('projects/%d/bundles/%d', $projectId, $bundleId);
        return $this->_delete($path);
    }

    /**
     * Edit Bundle
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.branches.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.branches.patch API Documentation Enterprise
     *
     * @param int $projectId
     * @param Bundle $bundle
     * @return Bundle|null
     */
    public function update(int $projectId, Bundle $bundle): ?Bundle
    {
        $path = sprintf('projects/%d/bundles/%d', $projectId, $bundle->getId());

        return $this->_update($path, $bundle);
    }

    /**
     * List Files
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.bundles.files.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.bundles.files.getMany API Documentation Enterprise
     * @param int $projectId
     * @param int $bundleId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listFiles(int $projectId, int $bundleId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/bundles/%d/files', $projectId, $bundleId);
        return $this->_list($path, File::class, $params);
    }

    /**
     * Export Bundle
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.bundles.exports.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.bundles.exports.post API Documentation Enterprise
     * @param int $projectId
     * @param int $bundleId
     * @return BundleExport
     */
    public function export(int $projectId, int $bundleId): BundleExport
    {
        $path = sprintf('projects/%d/bundles/%d/exports', $projectId, $bundleId);
        return $this->_post($path, BundleExport::class, []);
    }

    /**
     * Check Bundle Export Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.bundles.exports.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.bundles.exports.get API Documentation Enterprise
     * @param int $projectId
     * @param int $bundleId
     * @param string $exportId
     * @return BundleExport|null
     */
    public function checkExportStatus(int $projectId, int $bundleId, string $exportId): ?BundleExport
    {
        $path = sprintf('projects/%d/bundles/%d/exports/%s', $projectId, $bundleId, $exportId);
        return $this->_get($path, BundleExport::class);
    }

    /**
     * Download Bundle
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.bundles.exports.download.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.bundles.exports.download.get API Documentation Enterprise
     * @param int $projectId
     * @param int $bundleId
     * @param string $exportId
     * @return DownloadFile|null
     */
    public function download(int $projectId, int $bundleId, string $exportId): ?DownloadFile
    {
        $path = sprintf('projects/%d/bundles/%d/exports/%s/download', $projectId, $bundleId, $exportId);
        return $this->_get($path, DownloadFile::class);
    }
}
