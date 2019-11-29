<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Model\Glossary;

/**
 * Class GlossaryApi
 * @package Crowdin\Api
 */
class GlossaryApi extends \CrowdinApiClient\Api\GlossaryApi
{
    /**
     * @param string $name
     * @param int $groupId
     * @return Glossary|null
     */
    public function create(string $name, int $groupId = 0): ?Glossary
    {
        $params = [
            'name' => $name,
            'groupId' => $groupId
        ];
        return $this->_create('glossaries', Glossary::class, $params);
    }
}
