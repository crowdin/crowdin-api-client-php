<?php

namespace CrowdinApiClient\Http;

/**
 * @package CrowdinApiClient\Http
 * @ignore No documentation will be generated for this class
 */
interface ResponseErrorHandlerInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function check($data);
}
