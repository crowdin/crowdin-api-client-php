<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\MachineTranslation;
use CrowdinApiClient\Model\MachineTranslationEngine;
use CrowdinApiClient\ModelCollection;

/**
 * Machine Translation Engines (MTE) are the sources for pre-translations.
 *
 * @package Crowdin\Api
 */
class MachineTranslationEngineApi extends AbstractApi
{
    /**
     * List MTs
     * @link https://developer.crowdin.com/api/v2/#operation/api.mts.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.mts.getMany API Documentation Enterprise
     *
     * @param array $params
     * integer $params[groupId]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('mts', MachineTranslationEngine::class, $params);
    }

    /**
     * Get MT
     * @link https://developer.crowdin.com/api/v2/#operation/api.mts.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.mts.get API Documentation Enterprise
     *
     * @param int $mtId
     * @return MachineTranslationEngine|null
     */
    public function get(int $mtId): ?MachineTranslationEngine
    {
        return $this->_get('mts/' . $mtId, MachineTranslationEngine::class);
    }

    /**
     * Translate via MT
     * @link https://developer.crowdin.com/api/v2/#operation/api.mts.translations.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.mts.translations.post API Documentation Enterprise
     *
     * @param int $mtId
     * @param array $data
     * string $data[languageRecognitionProvider] Enum: "crowdin" "engine" Note: Is required if the source language is not selected<br>
     * string $data[sourceLanguageId]<br>
     * string $data[targetLanguageId] required<br>
     * string[] $data[strings] Note: You can translate up to 100 strings at a time.
     * @return MachineTranslation|null
     */
    public function translateViaMT(int $mtId, array $data): ?MachineTranslation
    {
        $path = sprintf('mts/%d/translations', $mtId);
        return $this->_post($path, MachineTranslation::class, $data);
    }
}
