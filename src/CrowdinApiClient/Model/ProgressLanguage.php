<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class ProgressLanguage extends BaseModel
{
    /**
     * @var array
     */
    protected $words;

    /**
     * @var array
     */
    protected $phrases;

    /**
     * @var integer
     */
    protected $translationProgress;

    /**
     * @var integer
     */
    protected $approvalProgress;

    /**
     * @var integer
     */
    protected $fileId;

    /**
     * @var string|null
     */
    protected $etag;

    /**
     * @var int|null
     */
    protected $branchId;

    /**
     * @var array
     */
    protected $qaChecksStatus;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->words = (array)$this->getDataProperty('words');
        $this->phrases = (array)$this->getDataProperty('phrases');
        $this->translationProgress = (int)$this->getDataProperty('translationProgress');
        $this->approvalProgress = (int)$this->getDataProperty('approvalProgress');
        $this->fileId = (int)$this->getDataProperty('fileId');
        $this->etag = $this->nullableString('eTag');
        $this->branchId = $this->nullableInt('branchId');
        $this->qaChecksStatus = (array)$this->getDataProperty('qaChecksStatus');
    }

    public function getWords(): array
    {
        return $this->words;
    }

    public function getPhrases(): array
    {
        return $this->phrases;
    }

    public function getTranslationProgress(): int
    {
        return $this->translationProgress;
    }

    public function getApprovalProgress(): int
    {
        return $this->approvalProgress;
    }

    public function getFileId(): int
    {
        return $this->fileId;
    }

    public function getEtag(): ?string
    {
        return $this->etag;
    }

    public function getBranchId(): ?int
    {
        return $this->branchId;
    }

    public function getQaChecksStatus(): array
    {
        return $this->qaChecksStatus;
    }
}
