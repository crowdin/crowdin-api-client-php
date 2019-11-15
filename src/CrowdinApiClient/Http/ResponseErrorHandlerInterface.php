<?php

namespace CrowdinApiClient\Http;

interface ResponseErrorHandlerInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function check($data);
}
