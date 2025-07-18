<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class PreTranslationReportFileStatistics extends BaseModel
{
    /**
     * @var int
     */
    protected $phrases;

    /**
     * @var int
     */
    protected $words;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->phrases = (int)$this->getDataProperty('phrases');
        $this->words = (int)$this->getDataProperty('words');
    }

    public function getPhrases(): int
    {
        return $this->phrases;
    }

    public function getWords(): int
    {
        return $this->words;
    }
}
