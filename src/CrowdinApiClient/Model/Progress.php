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
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->language = new Language($this->getDataProperty('language'));
        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->words = (array)$this->getDataProperty('words');
        $this->phrases = (array)$this->getDataProperty('phrases');
        $this->translationProgress = (int)$this->getDataProperty('translationProgress');
        $this->approvalProgress = (int)$this->getDataProperty('approvalProgress');
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getLanguageId(): string
    {
        return $this->languageId;
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
}
