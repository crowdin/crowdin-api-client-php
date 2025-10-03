<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\StringCorrection;
use CrowdinApiClient\ModelCollection;

/**
 * Use API to manage string corrections in Source Text Review workflow
 *
 * @package Crowdin\Api\Enterprise
 */
class StringCorrectionApi extends AbstractApi
{
    /**
     * List Corrections
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/String-Corrections/operation/api.projects.corrections.getMany API Documentation
     *
     * @param int $projectId
     * @param array $params
     * integer $params[stringId] required<br>
     * integer $params[limit] default: 25<br>
     * integer $params[offset] default: 0<br>
     * string $params[orderBy]<br>
     * integer $params[denormalizePlaceholders]
     *
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/corrections', $projectId);
        return $this->_list($path, StringCorrection::class, $params);
    }

    /**
     * Get Correction
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/String-Corrections/operation/api.projects.corrections.get API Documentation
     *
     * @param int $projectId
     * @param int $correctionId
     * @param array $params
     * integer $params[denormalizePlaceholders] default: 0
     *
     * @return StringCorrection|null
     */
    public function get(int $projectId, int $correctionId, array $params = []): ?StringCorrection
    {
        $path = sprintf('projects/%d/corrections/%d', $projectId, $correctionId);
        return $this->_get($path, StringCorrection::class, $params);
    }

    /**
     * Add Correction
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/String-Corrections/operation/api.projects.corrections.post API Documentation
     *
     * @param int $projectId
     * @param array $data
     * integer $data[stringId] required<br>
     * string $data[text] required<br>
     * string $data[pluralCategoryName]
     *
     * @return StringCorrection|null
     */
    public function create(int $projectId, array $data): ?StringCorrection
    {
        $path = sprintf('projects/%d/corrections', $projectId);
        return $this->_create($path, StringCorrection::class, $data);
    }

    /**
     * Restore Correction
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/String-Corrections/operation/api.projects.corrections.put API Documentation
     *
     * @param int $projectId
     * @param int $correctionId
     * @return StringCorrection|null
     */
    public function restore(int $projectId, int $correctionId): ?StringCorrection
    {
        $path = sprintf('projects/%d/corrections/%d', $projectId, $correctionId);
        return $this->_put($path, StringCorrection::class, []);
    }
}
