<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\ExternalQaCheck;
use CrowdinApiClient\ModelCollection;

/**
 * QA checks the organization runs through applications.
 *
 * @package Crowdin\Api\Enterprise
 */
class ExternalQaCheckApi extends AbstractApi
{
    /**
     * List External QA Checks
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.external-qa-checks.getMany API Documentation
     *
     * @param array $params
     * integer $params[projectId]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('external-qa-checks', ExternalQaCheck::class, $params);
    }

    /**
     * Get External QA Check
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.external-qa-checks.get API Documentation
     *
     * @param int $id
     * @return ExternalQaCheck|null
     */
    public function get(int $id): ?ExternalQaCheck
    {
        return $this->_get('external-qa-checks/' . $id, ExternalQaCheck::class);
    }
}
