<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class DistributionRelease extends BaseModel
{
    /**
     * @var string|null
     */
    protected $status;

    /**
     * @var int|null
     */
    protected $progress;

    /**
     * @var string|null
     */
    protected $currentLanguageId;

    /**
     * @var int|null
     */
    protected $currentFileId;

    /**
     * @var string|null
     */
    protected $date;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->status = (string)$this->getDataProperty('status');
        $this->progress = (integer)$this->getDataProperty('progress');
        $this->currentLanguageId = (string)$this->getDataProperty('currentLanguageId');
        $this->currentFileId = (integer)$this->getDataProperty('currentFileId');
        $this->date = (string)$this->getDataProperty('date');
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getProgress(): ?int
    {
        return $this->progress;
    }

    public function setProgress(?int $progress): void
    {
        $this->progress = $progress;
    }

    public function getCurrentLanguageId(): ?string
    {
        return $this->currentLanguageId;
    }

    public function setCurrentLanguageId(?string $currentLanguageId): void
    {
        $this->currentLanguageId = $currentLanguageId;
    }

    public function getCurrentFileId(): ?int
    {
        return $this->currentFileId;
    }

    public function setCurrentFileId(?int $currentFileId): void
    {
        $this->currentFileId = $currentFileId;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): void
    {
        $this->date = $date;
    }
}
