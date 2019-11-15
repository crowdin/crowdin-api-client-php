<?php

namespace CrowdinApiClient\Model;

/**
 * Class ProjectSetting
 * @package Crowdin\Model
 */
class ProjectSetting extends BaseModel
{
    /**
     * @var integer
     */
    protected $projectId;

    /**
     * @var integer
     */
    protected $translateDuplicates;

    /**
     * @var bool
     */
    protected $isMtAllowed;

    /**
     * @var bool
     */
    protected $autoSubstitution;

    /**
     * @var bool
     */
    protected $exportTranslatedOnly;

    /**
     * @var bool
     */
    protected $exportApprovedOnly;

    /**
     * @var bool
     */
    protected $autoTranslateDialects;

    /**
     * @var bool
     */
    protected $publicDownloads;

    /**
     * @var bool
     */
    protected $useGlobalTm;

    /**
     * @var bool
     */
    protected $inContext;

    /**
     * @var string
     */
    protected $pseudoLanguageId;

    /**
     * @var bool
     */
    protected $qaCheckIsActive;

    /**
     * @var integer
     */
    protected $lowestQualityProjectGoalId;

    /**
     * @var array
     */
    protected $qaCheckCategories = [];

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->projectId = (integer)$this->getDataProperty('projectId');
        $this->translateDuplicates = (integer)$this->getDataProperty('translateDuplicates');
        $this->isMtAllowed = (bool)$this->getDataProperty('isMtAllowed');
        $this->autoSubstitution = (bool)$this->getDataProperty('autoSubstitution');
        $this->exportTranslatedOnly = (bool)$this->getDataProperty('exportTranslatedOnly');
        $this->exportApprovedOnly = (bool)$this->getDataProperty('exportApprovedOnly');
        $this->autoTranslateDialects = (bool)$this->getDataProperty('autoTranslateDialects');
        $this->publicDownloads = (bool)$this->getDataProperty('publicDownloads');
        $this->useGlobalTm = (bool)$this->getDataProperty('useGlobalTm');
        $this->inContext = (bool)$this->getDataProperty('inContext');
        $this->pseudoLanguageId = (string)$this->getDataProperty('pseudoLanguageId');
        $this->qaCheckIsActive = (bool)$this->getDataProperty('qaCheckIsActive');
        $this->lowestQualityProjectGoalId = (integer)$this->getDataProperty('lowestQualityProjectGoalId');
        $this->qaCheckCategories = (array)$this->getDataProperty('qaCheckCategories');
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     */
    public function setProjectId(int $projectId): void
    {
        $this->projectId = $projectId;
    }

    /**
     * @return int
     */
    public function getTranslateDuplicates(): int
    {
        return $this->translateDuplicates;
    }

    /**
     * @param int $translateDuplicates
     */
    public function setTranslateDuplicates(int $translateDuplicates): void
    {
        $this->translateDuplicates = $translateDuplicates;
    }

    /**
     * @return bool
     */
    public function isMtAllowed(): bool
    {
        return $this->isMtAllowed;
    }

    /**
     * @param bool $isMtAllowed
     */
    public function setIsMtAllowed(bool $isMtAllowed): void
    {
        $this->isMtAllowed = $isMtAllowed;
    }

    /**
     * @return bool
     */
    public function isAutoSubstitution(): bool
    {
        return $this->autoSubstitution;
    }

    /**
     * @param bool $autoSubstitution
     */
    public function setAutoSubstitution(bool $autoSubstitution): void
    {
        $this->autoSubstitution = $autoSubstitution;
    }

    /**
     * @return bool
     */
    public function isExportTranslatedOnly(): bool
    {
        return $this->exportTranslatedOnly;
    }

    /**
     * @param bool $exportTranslatedOnly
     */
    public function setExportTranslatedOnly(bool $exportTranslatedOnly): void
    {
        $this->exportTranslatedOnly = $exportTranslatedOnly;
    }

    /**
     * @return bool
     */
    public function isExportApprovedOnly(): bool
    {
        return $this->exportApprovedOnly;
    }

    /**
     * @param bool $exportApprovedOnly
     */
    public function setExportApprovedOnly(bool $exportApprovedOnly): void
    {
        $this->exportApprovedOnly = $exportApprovedOnly;
    }

    /**
     * @return bool
     */
    public function isAutoTranslateDialects(): bool
    {
        return $this->autoTranslateDialects;
    }

    /**
     * @param bool $autoTranslateDialects
     */
    public function setAutoTranslateDialects(bool $autoTranslateDialects): void
    {
        $this->autoTranslateDialects = $autoTranslateDialects;
    }

    /**
     * @return bool
     */
    public function isPublicDownloads(): bool
    {
        return $this->publicDownloads;
    }

    /**
     * @param bool $publicDownloads
     */
    public function setPublicDownloads(bool $publicDownloads): void
    {
        $this->publicDownloads = $publicDownloads;
    }

    /**
     * @return bool
     */
    public function isUseGlobalTm(): bool
    {
        return $this->useGlobalTm;
    }

    /**
     * @param bool $useGlobalTm
     */
    public function setUseGlobalTm(bool $useGlobalTm): void
    {
        $this->useGlobalTm = $useGlobalTm;
    }

    /**
     * @return bool
     */
    public function isInContext(): bool
    {
        return $this->inContext;
    }

    /**
     * @param bool $inContext
     */
    public function setInContext(bool $inContext): void
    {
        $this->inContext = $inContext;
    }

    /**
     * @return string
     */
    public function getPseudoLanguageId(): string
    {
        return $this->pseudoLanguageId;
    }

    /**
     * @param string $pseudoLanguageId
     */
    public function setPseudoLanguageId(string $pseudoLanguageId): void
    {
        $this->pseudoLanguageId = $pseudoLanguageId;
    }

    /**
     * @return bool
     */
    public function isQaCheckIsActive(): bool
    {
        return $this->qaCheckIsActive;
    }

    /**
     * @param bool $qaCheckIsActive
     */
    public function setQaCheckIsActive(bool $qaCheckIsActive): void
    {
        $this->qaCheckIsActive = $qaCheckIsActive;
    }

    /**
     * @return int
     */
    public function getLowestQualityProjectGoalId(): int
    {
        return $this->lowestQualityProjectGoalId;
    }

    /**
     * @param int $lowestQualityProjectGoalId
     */
    public function setLowestQualityProjectGoalId(int $lowestQualityProjectGoalId): void
    {
        $this->lowestQualityProjectGoalId = $lowestQualityProjectGoalId;
    }

    /**
     * @return array
     */
    public function getQaCheckCategories(): array
    {
        return $this->qaCheckCategories;
    }

    /**
     * @param array $qaCheckCategories
     */
    public function setQaCheckCategories(array $qaCheckCategories): void
    {
        $this->qaCheckCategories = $qaCheckCategories;
    }
}
