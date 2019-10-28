<?php


namespace Crowdin\Model;

/**
 * Class DownloadFile
 * @package Crowdin\Model
 */
class DownloadFile extends BaseModel
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $expireIn;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->url = $this->getDataProperty('url');
        $this->expireIn = $this->getDataProperty('expireIn');
    }
}
