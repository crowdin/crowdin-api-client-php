<?php

namespace Crowdin\Api;

use Crowdin\Crowdin;

/**
 * Class AbstractApi
 * @package Crowdin\Api
 */
abstract class AbstractApi implements ApiInterface
{
    /**
     * @var Crowdin
     */
    public $client;

    /**
     * AbstractApi constructor.
     * @param Crowdin $client
     */
    public function __construct(Crowdin $client)
    {
        $this->client = $client;
    }
}
