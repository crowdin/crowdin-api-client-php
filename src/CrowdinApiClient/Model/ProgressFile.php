<?php

namespace CrowdinApiClient\Model;

/**
 * Class ProgressFile
 * @package Crowdin\Model
 */
class ProgressFile extends Progress
{
    /**
     * @var string|null
     */
    protected $etag;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->etag = $this->getDataProperty('eTag');
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
