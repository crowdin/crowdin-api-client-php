<?php


namespace Crowdin\Api;

use Crowdin\Api\Traits\GrudTrait;
use Crowdin\Model\Language;

/**
 * Class LanguageApi
 * @package Crowdin\Api
 */
class LanguageApi extends AbstractApi
{
    use GrudTrait;

    /**
     * @return mixed
     */
    public function list()
    {
        return $this->_list('languages', Language::class);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->_create('languages', Language::class, $data);
    }

    /**
     * @param int $languageId
     * @return Language|null
     */
    public function get(int $languageId):?Language
    {
        return $this->_get('languages/'.$languageId, Language::class);
    }

    /**
     * @param int $languageId
     * @return mixed
     */
    public function delete(int $languageId)
    {
        return $this->_delete('languages'.$languageId);
    }

    /**
     * @param Language $language
     * @return Language|mixed
     */
    public function update(Language $language):?Language
    {
        return $this->_update('languages', $language);
    }
}
