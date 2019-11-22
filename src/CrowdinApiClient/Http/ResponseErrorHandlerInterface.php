<?php

namespace CrowdinApiClient\Http;

/**
 * Interface ResponseErrorHandlerInterface
 * @package CrowdinApiClient\Http
 */
interface ResponseErrorHandlerInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function check($data);
}
