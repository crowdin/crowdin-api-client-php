<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Api\Traits\TranslationTrait;
use CrowdinApiClient\Model\TranslationProjectBuild;

class TranslationApi extends AbstractApi
{
    use TranslationTrait;

    /**
     * @param int $projectId
     * @param array $params
     * @internal integer $params[branchId]
     * @internal array $params[targetLanguageIds]
     * @internal bool $params[exportTranslatedOnly]
     * @internal bool $params[exportApprovedOnly]
     * @return TranslationProjectBuild|null
     */
    public function buildProject(int $projectId, array $params = []): ?TranslationProjectBuild
    {
        $patch = sprintf('projects/%d/translations/builds', $projectId);

        return $this->_post($patch, TranslationProjectBuild::class, $params);
    }
}
