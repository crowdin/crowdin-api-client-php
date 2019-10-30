<?php

namespace Crowdin\Http;

interface ResponseErrorHandlerInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function check($data);
}
