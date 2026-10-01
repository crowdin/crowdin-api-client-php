<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Dictionary;
use CrowdinApiClient\ModelCollection;

/**
 * Project dictionaries hold the words that spellcheck should accept for each language.
 *
 * @package Crowdin\Api
 */
class DictionaryApi extends AbstractApi
{
    /**
     * List Dictionaries
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.dictionaries.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.dictionaries.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * string $params[languageIds] Comma-separated list of language identifiers
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        return $this->_list(sprintf('projects/%d/dictionaries', $projectId), Dictionary::class, $params);
    }

    /**
     * Edit Dictionary
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.dictionaries.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.dictionaries.patch API Documentation Enterprise
     *
     * @param int $projectId
     * @param string $languageId
     * @param array $data JSON Patch array. op: add or remove, path: /words/{index}, value: word (for add)
     * @return Dictionary|null
     */
    public function update(int $projectId, string $languageId, array $data): ?Dictionary
    {
        return $this->_patch(
            sprintf('projects/%d/dictionaries/%s', $projectId, $languageId),
            Dictionary::class,
            $data
        );
    }
}
