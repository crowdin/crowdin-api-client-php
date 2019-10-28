<?php


namespace Crowdin\Http;


use Crowdin\Exceptions\ApiException;
use Crowdin\Exceptions\ApiValidationException;

/**
 * Class ResponseErrorHandler
 * @package Crowdin\Http
 */
class ResponseErrorHandler implements ResponseErrorHandlerInterface
{
    /**
     * @param $data
     * @return mixed
     * @throws ApiValidationException
     * @throws ApiException
     */
    public function check($data)
    {
        if(isset($data['errors']))
        {
            throw new ApiValidationException($data['errors']);
        }elseif (isset($data['error']))
        {
            throw new ApiException($data['error']['message'], $data['error']['code']);
        }
    }
}
