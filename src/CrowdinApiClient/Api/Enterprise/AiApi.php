<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\AiTranslation;

/**
 * Use API to leverage AI-powered translation of strings.
 *
 * @package Crowdin\Api\Enterprise
 */
class AiApi extends AbstractApi
{
    /**
     * AI Translate Strings
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.translate.strings.post API Documentation
     *
     * @param array $data
     * array $data[strings] required<br>
     * string $data[targetLanguageId] required<br>
     * string $data[sourceLanguageId]<br>
     * array $data[tmIds]<br>
     * array $data[glossaryIds]<br>
     * integer $data[aiPromptId]<br>
     * integer $data[aiProviderId]<br>
     * string $data[aiModelId]<br>
     * array $data[instructions]<br>
     * array $data[attachmentIds]
     * @return AiTranslation|null
     */
    public function translateStrings(array $data): ?AiTranslation
    {
        return $this->_post('ai/translate', AiTranslation::class, $data);
    }
}
