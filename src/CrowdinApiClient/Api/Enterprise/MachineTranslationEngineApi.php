<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\MachineTranslationEngineApi as CrowdinMachineTranslationEngineApi;
use CrowdinApiClient\Model\MachineTranslationEngine;

/**
 * Machine Translation Engines (MTE) are the sources for pre-translations.
 * You can currently connect Google Translate, Microsoft Translator, DeepL Pro, Amazon Translate, and Watson (IBM) Translate engines.
 * Use API to add, update, and delete specific MTE.
 *
 * @package Crowdin\Api\Enterprise
 */
class MachineTranslationEngineApi extends CrowdinMachineTranslationEngineApi
{
    /**
     * Add MT
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.mts.post API Documentation
     *
     * @param array $data
     * string $data[name] required<br>
     * string $data[type] required<br>
     * array $data[credentials] required<br>
     * integer $data[groupId]
     * @return MachineTranslationEngine|null
     */
    public function create(array $data): ?MachineTranslationEngine
    {
        return $this->_create('mts', MachineTranslationEngine::class, $data);
    }

    /**
     * Edit MT
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.mts.patch API Documentation
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
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.mts.delete API Documentation
     *
     * @param int $mtId
     * @return mixed
     */
    public function delete(int $mtId)
    {
        return $this->_delete('mts/' . $mtId);
    }
}
