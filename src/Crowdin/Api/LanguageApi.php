<?php


namespace Crowdin\Api;

use Crowdin\Http\ResponseDecorator\ResponseModelDecorator;
use Crowdin\Http\ResponseDecorator\ResponseModelListDecorator;
use Crowdin\Model\Language;

/**
 * Class LanguageApi
 * @package Crowdin\Api
 */
class LanguageApi extends AbstractApi
{
    public function all()
    {
        return $this->client->apiRequest('get', 'languages', new ResponseModelListDecorator(Language::class));
    }

    public function add($data)
    {
        //TODO
        $options = [
            'body' => json_encode($data),
            'headers' => ['Content-Type' => 'application/json']
        ];
        return $this->client->apiRequest('post', 'languages', new ResponseModelDecorator(Language::class), $options);
    }

    /**
     * @param int $languageId
     * @return Language|null
     */
    public function get(int $languageId):?Language
    {
        return $this->client->apiRequest('get', 'languages/'.$languageId, new ResponseModelDecorator(Language::class));
    }

    public function delete(int $languageId)
    {
        return $this->client->apiRequest('delete', 'languages'.$languageId);
    }

    public function update()
    {

    }
}
