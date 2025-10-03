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
}
