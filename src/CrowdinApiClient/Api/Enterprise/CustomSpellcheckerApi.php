<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\CustomSpellchecker;
use CrowdinApiClient\ModelCollection;

/**
 * Spellcheckers the organization added through applications.
 *
 * @package Crowdin\Api\Enterprise
 */
class CustomSpellcheckerApi extends AbstractApi
{
    /**
     * List Custom Spellcheckers
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.custom-spellcheckers.getMany API Documentation
     *
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('custom-spellcheckers', CustomSpellchecker::class, $params);
    }

    /**
     * Get Custom Spellchecker
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.custom-spellcheckers.get API Documentation
     *
     * @param int $id
     * @return CustomSpellchecker|null
     */
    public function get(int $id): ?CustomSpellchecker
    {
        return $this->_get('custom-spellcheckers/' . $id, CustomSpellchecker::class);
    }
}
