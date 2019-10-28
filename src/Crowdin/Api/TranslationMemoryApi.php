<?php


namespace Crowdin\Api;

use Crowdin\Model\TranslationMemory;

/**
 * Class TranslationMemoryApi
 * @package Crowdin\Api
 */
class TranslationMemoryApi extends AbstractApi
{
    public function list()
    {

    }

    public function get(int $translationMemoryId)
    {

    }

    public function create(array $data)
    {

    }

    public function update(TranslationMemory $translationMemory)
    {

    }

    /**
     * @param int $translationMemoryId
     * @return mixed
     */
    public function delete(int $translationMemoryId)
    {
        return $this->client->apiRequest('delete', ''.$translationMemoryId);
    }
}
