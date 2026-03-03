<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\AiTranslation;

/**
 * Use API to leverage AI-powered translation of strings.
 *
 * @package Crowdin\Api
 */
class AiApi extends AbstractApi
{
    /**
     * AI Translate Strings
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.translate.strings.post API Documentation
     *
     * @param int $userId
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
    public function translateStrings(int $userId, array $data): ?AiTranslation
    {
        $path = sprintf('users/%d/ai/translate', $userId);
        return $this->_post($path, AiTranslation::class, $data);
    }
}
