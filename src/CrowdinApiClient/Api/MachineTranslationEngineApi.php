<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\MachineTranslationEngine;
use CrowdinApiClient\ModelCollection;

/**
 * Machine Translation Engines (MTE) are the sources for pre-translations.
 * You can currently connect Google Translate, Microsoft Translator, DeepL Pro, Amazon Translate, and Watson (IBM) Translate engines.
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
}
