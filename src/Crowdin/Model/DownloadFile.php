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
        $this->url = (string)$this->getDataProperty('url');
        $this->expireIn = (string)$this->getDataProperty('expireIn');
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getExpireIn(): string
    {
        return $this->expireIn;
    }

    /**
     * @param string $expireIn
     */
    public function setExpireIn(string $expireIn): void
    {
        $this->expireIn = $expireIn;
    }
}
