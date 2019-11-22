<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\MachineTranslationEngine;
use CrowdinApiClient\ModelCollection;

/**
 * Class MachineTranslationEngineApi
 * @package Crowdin\Api
 */
class MachineTranslationEngineApi extends AbstractApi
{
    /**
     * @param int $groupId
     * @param array $params
     * @return ModelCollection
     */
    public function list(int $groupId, array $params = []): ModelCollection
    {
        $params['groupId'] = $groupId;
        return $this->_list('mts', MachineTranslationEngine::class, $params);
    }

    /**
     * @param int $mtId
     * @return MachineTranslationEngine|null
     */
    public function get(int $mtId): ?MachineTranslationEngine
    {
        return $this->_get('mts/' . $mtId, MachineTranslationEngine::class);
    }

    /**
     * @param array $data
     * @internal string $data[name] required
     * @internal string $data[type] required Enum: "google" "microsoft" "yandex" "deepl" "amazon" "watson"
     * @internal array $data[credentials] required
     * @internal integer $data[groupId]
     * @return MachineTranslationEngine|null
     */
    public function create(array $data): ?MachineTranslationEngine
    {
        return $this->_create('mts', MachineTranslationEngine::class, $data);
    }

    /**
     * @param MachineTranslationEngine $machineTranslationEngine
     * @return MachineTranslationEngine|null
     */
    public function update(MachineTranslationEngine $machineTranslationEngine): ?MachineTranslationEngine
    {
        return $this->_update('mts/' . $machineTranslationEngine->getId(), $machineTranslationEngine);
    }

    /**
     * @param int $mtId
     * @return mixed
     */
    public function delete(int $mtId)
    {
        return $this->_delete('mts/' . $mtId);
    }
}
