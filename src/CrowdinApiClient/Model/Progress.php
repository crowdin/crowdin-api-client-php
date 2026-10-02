<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Progress extends BaseModel
{
    /**
     * @var Language $language
     */
    protected $language;

    /**
     * @var string
     */
    protected $languageId;

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
     * @var array
     */
    protected $qaChecksStatus;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->language = new Language($this->getDataProperty('language'));
        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->words = (array)$this->getDataProperty('words');
        $this->phrases = (array)$this->getDataProperty('phrases');
        $this->translationProgress = (int)$this->getDataProperty('translationProgress');
        $this->approvalProgress = (int)$this->getDataProperty('approvalProgress');
        $this->qaChecksStatus = (array)$this->getDataProperty('qaChecksStatus');
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function getLanguageId(): string
    {
        return $this->languageId;
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

    public function getQaChecksStatus(): array
    {
        return $this->qaChecksStatus;
    }
}
