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
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->words = (array)$this->getDataProperty('words');
        $this->phrases = (array)$this->getDataProperty('phrases');
        $this->translationProgress = (integer)$this->getDataProperty('translationProgress');
        $this->approvalProgress = (integer)$this->getDataProperty('approvalProgress');
        $this->fileId = (integer)$this->getDataProperty('fileId');
        $this->etag = (string)$this->getDataProperty('eTag');
    }

    /**
     * @return array
     */
    public function getWords(): array
    {
        return $this->words;
    }

    /**
     * @return array
     */
    public function getPhrases(): array
    {
        return $this->phrases;
    }

    /**
     * @return int
     */
    public function getTranslationProgress(): int
    {
        return $this->translationProgress;
    }

    /**
     * @return int
     */
    public function getApprovalProgress(): int
    {
        return $this->approvalProgress;
    }

    /**
     * @return int
     */
    public function getFileId(): int
    {
        return $this->fileId;
    }

    /**
     * @return string|null
     */
    public function getEtag(): ?string
    {
        return $this->etag;
    }
}
