<?php


namespace Crowdin\Model;

/**
 * Class Progress
 * @package Crowdin\Model
 */
class Progress extends BaseModel
{
    /**
     * @var string
     */
    protected $pk = 'languageId';

    /**
     * @var string
     */
    protected $languageId;

    /**
     * @var integer
     */
    protected $phrasesCount;

    /**
     * @var integer
     */
    protected $phrasesTranslatedCount;

    /**
     * @var integer
     */
    protected $phrasesApprovedCount;

    /**
     * @var integer
     */
    protected $phrasesTranslatedProgress;

    /**
     * @var integer
     */
    protected $phrasesApprovedProgress;


    /**
     * Progress constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->phrasesCount = (integer)$this->getDataProperty('phrasesCount');
        $this->phrasesTranslatedCount = (integer)$this->getDataProperty('phrasesTranslatedCount');
        $this->phrasesApprovedCount = (integer)$this->getDataProperty('phrasesApprovedCount');
        $this->phrasesTranslatedProgress = (integer)$this->getDataProperty('phrasesTranslatedProgress');
        $this->phrasesApprovedProgress = (integer)$this->getDataProperty('phrasesApprovedProgress');
    }

    /**
     * @return string
     */
    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    /**
     * @param string $languageId
     */
    public function setLanguageId(string $languageId): void
    {
        $this->languageId = $languageId;
    }

    /**
     * @return int
     */
    public function getPhrasesCount(): int
    {
        return $this->phrasesCount;
    }

    /**
     * @param int $phrasesCount
     */
    public function setPhrasesCount(int $phrasesCount): void
    {
        $this->phrasesCount = $phrasesCount;
    }

    /**
     * @return int
     */
    public function getPhrasesTranslatedCount(): int
    {
        return $this->phrasesTranslatedCount;
    }

    /**
     * @param int $phrasesTranslatedCount
     */
    public function setPhrasesTranslatedCount(int $phrasesTranslatedCount): void
    {
        $this->phrasesTranslatedCount = $phrasesTranslatedCount;
    }

    /**
     * @return int
     */
    public function getPhrasesApprovedCount(): int
    {
        return $this->phrasesApprovedCount;
    }

    /**
     * @param int $phrasesApprovedCount
     */
    public function setPhrasesApprovedCount(int $phrasesApprovedCount): void
    {
        $this->phrasesApprovedCount = $phrasesApprovedCount;
    }

    /**
     * @return int
     */
    public function getPhrasesTranslatedProgress(): int
    {
        return $this->phrasesTranslatedProgress;
    }

    /**
     * @param int $phrasesTranslatedProgress
     */
    public function setPhrasesTranslatedProgress(int $phrasesTranslatedProgress): void
    {
        $this->phrasesTranslatedProgress = $phrasesTranslatedProgress;
    }

    /**
     * @return int
     */
    public function getPhrasesApprovedProgress(): int
    {
        return $this->phrasesApprovedProgress;
    }

    /**
     * @param int $phrasesApprovedProgress
     */
    public function setPhrasesApprovedProgress(int $phrasesApprovedProgress): void
    {
        $this->phrasesApprovedProgress = $phrasesApprovedProgress;
    }
}
