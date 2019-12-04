<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Language;
use CrowdinApiClient\ModelCollection;

/**
 * Class LanguageApi
 * @package Crowdin\Api
 */
class LanguageApi extends AbstractApi
{
    /**
     * List Supported Languages
     * @link https://support.crowdin.com/api/v2/#operation/api.languages.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.languages.getMany API Documentation Enterprise
     *
     * @param array $params
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('languages', Language::class, $params);
    }

    /**
     * Add Custom Language
     * @link https://support.crowdin.com/api/v2/#operation/api.languages.post API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.languages.post API Documentation Enterprise
     *
     * @param array $data
     * @internal string $data[name] required
     * @internal string $data[code] required
     * @internal string $data[localeCode] required
     * @internal string $data[textDirection] required
     * @internal array $data[pluralCategoryNames] required
     * @internal array $data[threeLettersCode] required
     * @internal string $data[twoLettersCode]
     * @internal string $data[dialectOf]
     * @return Language|null
     */
    public function create(array $data): ?Language
    {
        return $this->_create('languages', Language::class, $data);
    }

    /**
     * Get Language Info
     * @link https://support.crowdin.com/api/v2/#operation/api.languages.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.languages.get API Documentation Enterprise
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
     * @link https://support.crowdin.com/api/v2/#operation/api.languages.delete API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.languages.delete API Documentation Enterprise
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
     * @link https://support.crowdin.com/api/v2/#operation/api.languages.patch API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.languages.patch API Documentation Enterprise
     *
     * @param Language $language
     * @return Language|mixed
     */
    public function update(Language $language): ?Language
    {
        return $this->_update('languages/' . $language->getId(), $language);
    }
}
