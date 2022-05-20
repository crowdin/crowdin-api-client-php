<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\MachineTranslationEngine;
use CrowdinApiClient\ModelCollection;

/**
 * Machine Translation Engines (MTE) are the sources for pre-translations.
 * You can currently connect Google Translate, Microsoft Translator, DeepL Pro, Amazon Translate, and Watson (IBM) Translate engines.
 * Use API to add, update, and delete specific MTE.
 *
 * @package Crowdin\Api\Enterprise
 */
class MachineTranslationEngineApi extends AbstractApi
{
    /**
     * List MTs
     * @link https://support.crowdin.com/enterprise/api/#operation/api.mts.getMany API Documentation
     *
     * @param array $params
     * @internal integer $params[groupId]
     * @internal integer $params[limit]
     * @internal integer $params[offset]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('mts', MachineTranslationEngine::class, $params);
    }

    /**
     * Get MT
     * @link https://support.crowdin.com/enterprise/api/#operation/api.mts.get API Documentation
     *
     * @param int $mtId
     * @return MachineTranslationEngine|null
     */
    public function get(int $mtId): ?MachineTranslationEngine
    {
        return $this->_get('mts/' . $mtId, MachineTranslationEngine::class);
    }

    /**
     * Add MT
     * @link https://support.crowdin.com/enterprise/api/#operation/api.mts.post API Documentation
     *
     * @param array $data
     * @internal string $data[name] required
     * @internal string $data[type] required Enum: "google" "google_automl" "microsoft" "yandex" "deepl" "amazon" "watson"
     * @internal array $data[credentials] required
     * @internal integer $data[groupId]
     * @return MachineTranslationEngine|null
     */
    public function create(array $data): ?MachineTranslationEngine
    {
        return $this->_create('mts', MachineTranslationEngine::class, $data);
    }

    /**
     * Edit MT
     * @link https://support.crowdin.com/enterprise/api/#operation/api.mts.patch API Documentation
     *
     * @param MachineTranslationEngine $machineTranslationEngine
     * @return MachineTranslationEngine|null
     */
    public function update(MachineTranslationEngine $machineTranslationEngine): ?MachineTranslationEngine
    {
        return $this->_update('mts/' . $machineTranslationEngine->getId(), $machineTranslationEngine);
    }

    /**
     * Delete MT
     * @link https://support.crowdin.com/enterprise/api/#operation/api.mts.delete API Documentation
     *
     * @param int $mtId
     * @return mixed
     */
    public function delete(int $mtId)
    {
        return $this->_delete('mts/' . $mtId);
    }
}
