<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Api\Traits\TranslationTrait;
use CrowdinApiClient\Model\TranslationProjectBuild;

class TranslationApi extends AbstractApi
{
    use TranslationTrait;
    /**
     * @param int $projectId
     * @param int $branchId
     * @param array $targetLanguageIds
     * @return TranslationProjectBuild|null
     */
    public function buildProject(int $projectId, int $branchId, array $targetLanguageIds): ?TranslationProjectBuild
    {
        $patch = sprintf('projects/%d/translations/builds', $projectId);

        $data = [
            'branchId' => $branchId,
            'targetLanguageIds' => $targetLanguageIds
        ];

        return $this->_post($patch, TranslationProjectBuild::class, $data);
    }
}
