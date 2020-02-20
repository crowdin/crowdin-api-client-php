<?php

namespace CrowdinApiClient\Model;

/**
 * Class DownloadFileTranslation
 * @package Crowdin\Model
 */
class DownloadFileTranslation extends DownloadFile
{
    /**
     * @var string|null
     */
    protected $etag;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->etag = $this->getDataProperty('etag');
    }

    /**
     * @return string|null
     */
    public function getEtag(): ?string
    {
        return $this->etag;
    }

    /**
     * @param string|null $etag
     */
    public function setEtag(?string $etag): void
    {
        $this->etag = $etag;
    }
}
