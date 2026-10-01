<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class DownloadFilePreview extends BaseModel
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

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getExpireIn(): string
    {
        return $this->expireIn;
    }

    public function setExpireIn(string $expireIn): void
    {
        $this->expireIn = $expireIn;
    }
}
