<?php

namespace Crowdin\Api;

use Crowdin\Model\MachineTranslationEngine;

/**
 * Class MachineTranslationEngineApi
 * @package Crowdin\Api
 */
class MachineTranslationEngineApi extends AbstractApi
{
    public function list(int $groupId)
    {
        //TODO query param
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
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->_create('mts', MachineTranslationEngine::class, $data);
    }

    /**
     * @param MachineTranslationEngine $machineTranslationEngine
     * @return MachineTranslationEngine|null
     */
    public function update(MachineTranslationEngine $machineTranslationEngine): ?MachineTranslationEngine
    {
        return $this->_update('mts', $machineTranslationEngine);
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
