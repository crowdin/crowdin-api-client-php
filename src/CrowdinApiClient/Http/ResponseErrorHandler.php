<?php

namespace CrowdinApiClient\Http;

use CrowdinApiClient\Exceptions\ApiException;
use CrowdinApiClient\Exceptions\ApiValidationException;

/**
 * Class ResponseErrorHandler
 * @package Crowdin\Http
 * @internal
 */
class ResponseErrorHandler implements ResponseErrorHandlerInterface
{
    /**
     * @param $data
     * @throws ApiValidationException
     * @throws ApiException
     */
    public function check($data)
    {
        if (isset($data['errors'])) {
            $apiValidationException = new ApiValidationException('Api validation errors');
            $apiValidationException->setErrors($data['errors']);

            throw $apiValidationException;
        }

        if (isset($data['error'])) {
            throw new ApiException($data['error']['message'], $data['error']['code']);
        }
    }
}
