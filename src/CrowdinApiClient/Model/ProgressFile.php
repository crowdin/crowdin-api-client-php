<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class ProgressFile extends Progress
{
    /**
     * @var string|null
     */
    protected $etag;

    /**
     * @var array
     */
    protected $qaChecksStatus;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->etag = $this->getDataProperty('eTag');
        $this->qaChecksStatus = (array)$this->getDataProperty('qaChecksStatus');
    }

    public function getEtag(): ?string
    {
        return $this->etag;
    }

    public function setEtag(?string $etag): void
    {
        $this->etag = $etag;
    }

    public function getQaChecksStatus(): array
    {
        return $this->qaChecksStatus;
    }
}
