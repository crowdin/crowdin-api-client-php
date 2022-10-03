<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Language;
use CrowdinApiClient\ModelCollection;

/**
 * Crowdin supports more than 300 world languages and custom languages created in the system.
 * Use API to get the list of all supported languages and retrieve additional details (e.g. text direction, internal code) on specific language.
 *
 * @package Crowdin\Api
 */
class LanguageApi extends AbstractApi
{
    /**
     * List Supported Languages
     * @link https://developer.crowdin.com/api/v2/#operation/api.languages.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.languages.getMany API Documentation Enterprise
     *
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('languages', Language::class, $params);
    }

    /**
     * Add Custom Language
     * @link https://developer.crowdin.com/api/v2/#operation/api.languages.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.languages.post API Documentation Enterprise
     *
     * @param array $data
     * string $data[name] required<br>
     * string $data[code] required<br>
     * string $data[localeCode] required<br>
     * string $data[textDirection] required<br>
     * string[] $data[pluralCategoryNames] required<br>
     * string $data[threeLettersCode] required<br>
     * string $data[twoLettersCode]<br>
     * string $data[dialectOf]
     * @return Language|null
     */
    public function create(array $data): ?Language
    {
        return $this->_create('languages', Language::class, $data);
    }

    /**
     * Get Language Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.languages.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.languages.get API Documentation Enterprise
     *
     * @param string $languageId
     * @return Language|null
     */
    public function get(string $languageId): ?Language
    {
        return $this->_get('languages/' . $languageId, Language::class);
    }

    /**
     * Delete Custom Language
     * @link https://developer.crowdin.com/api/v2/#operation/api.languages.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.languages.delete API Documentation Enterprise
     *
     * @param string $languageId
     * @return mixed
     */
    public function delete(string $languageId)
    {
        return $this->_delete('languages/' . $languageId);
    }

    /**
     * Edit Custom Language
     * @link https://developer.crowdin.com/api/v2/#operation/api.languages.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.languages.patch API Documentation Enterprise
     *
     * @param Language $language
     * @return Language|mixed
     */
    public function update(Language $language): ?Language
    {
        return $this->_update('languages/' . $language->getId(), $language);
    }
}
