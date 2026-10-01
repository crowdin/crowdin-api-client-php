<?php

namespace CrowdinApiClient\Model;

/**
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

        $this->etag = $this->nullableString('etag');
    }

    public function getEtag(): ?string
    {
        return $this->etag;
    }

    public function setEtag(?string $etag): void
    {
        $this->etag = $etag;
    }
}
