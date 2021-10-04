<?php

namespace CrowdinApiClient\Model;

/**
 * Class Project
 * @package Crowdin\Model
 */
class Project extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $groupId;

    /**
     * @var integer
     */
    protected $userId;

    /**
     * @var string
     */
    protected $sourceLanguageId;

    /**
     * @var array
     */
    protected $targetLanguageIds = [];

    /**
     * @var array
     */
    protected $targetLanguages;

    /**
     * @var string
     */
    protected $languageAccessPolicy;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $cname;

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $visibility;

    /**
     * @var string
     */
    protected $logo;

    /**
     * @var string
     */
    protected $background;

    /**
     * @var bool
     */
    protected $isExternal;

    /**
     * @var string
     */
    protected $externalType;

    /**
     * @var integer
     */
    protected $workflowId;

    /**
     * @var bool
     */
    protected $hasCrowdsourcing;

    /**
     * @var bool
     */
    protected $publicDownloads;

    /**
     * @var bool
     */
    protected $hiddenStringsProofreadersAccess;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * @var string
     */
    protected $lastActivity;

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
     * @var boolean
     */
    protected $exportTranslatedOnly;

    /**
     * @var bool
     */
    protected $skipUntranslatedStrings;

    /**
     * @var bool
     */
    protected $skipUntranslatedFiles;

    /**
     * @var integer
     */
    protected $exportWithMinApprovalsCount;

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
    protected $useGlobalTm;

    /**
     * @var bool
     */
    protected $inContext;

    /**
     * @var bool
     */
    protected $inContextProcessHiddenStrings;

    /**
     * @var ?string
     */
    protected $inContextPseudoLanguageId;

    /**
     * @var array
     */
    protected $inContextPseudoLanguage = [];

    /**
     * @var bool
     */
    protected $isSuspended;

    /**
     * @var bool
     */
    protected $qaCheckIsActive;

    /**
     * @var array
     */
    protected $qaCheckCategories = [];

    /**
     * @var int[]
     */
    protected $customQaCheckIds = [];

    /**
     * @var array
     */
    protected $languageMapping = [];

    /**
     * @var bool
     */
    protected $glossaryAccess;

    /**
     * @var bool
     */
    protected $normalizePlaceholder;

    /**
     * @var bool
     */
    protected $saveMetaInfoInSource;

    /**
     * @var array
     */
    protected $notificationSettings = [];

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (integer)$this->getDataProperty('id');
        $this->groupId = (integer)$this->getDataProperty('groupId');
        $this->userId = (integer)$this->getDataProperty('userId');
        $this->sourceLanguageId = (string)$this->getDataProperty('sourceLanguageId');
        $this->targetLanguageIds = (array)$this->getDataProperty('targetLanguageIds');
        $this->targetLanguages = (array)$this->getDataProperty('targetLanguages');
        $this->languageAccessPolicy = (string)$this->getDataProperty('languageAccessPolicy');
        $this->name = (string)$this->getDataProperty('name');
        $this->cname = (string)$this->getDataProperty('cname');
        $this->identifier = (string)$this->getDataProperty('identifier');
        $this->description = (string)$this->getDataProperty('description');
        $this->visibility = (string)$this->getDataProperty('visibility');
        $this->logo = (string)$this->getDataProperty('logo');
        $this->background = (string)$this->getDataProperty('background');
        $this->isExternal = (bool)$this->getDataProperty('isExternal');
        $this->externalType = (string)$this->getDataProperty('externalType');
        $this->workflowId = (integer)$this->getDataProperty('workflowId');
        $this->hasCrowdsourcing = (bool)$this->getDataProperty('hasCrowdsourcing');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
        $this->lastActivity = (string)$this->getDataProperty('lastActivity');

        $this->translateDuplicates = (integer)$this->getDataProperty('translateDuplicates');
        $this->isMtAllowed = (bool)$this->getDataProperty('isMtAllowed');
        $this->autoSubstitution = (bool)$this->getDataProperty('autoSubstitution');
        $this->skipUntranslatedStrings = (bool)$this->getDataProperty('skipUntranslatedStrings');
        $this->skipUntranslatedFiles = (bool)$this->getDataProperty('skipUntranslatedFiles');
        $this->exportWithMinApprovalsCount = (integer)$this->getDataProperty('exportWithMinApprovalsCount');
        $this->exportApprovedOnly = (bool)$this->getDataProperty('exportApprovedOnly');
        $this->autoTranslateDialects = (bool)$this->getDataProperty('autoTranslateDialects');
        $this->publicDownloads = (bool)$this->getDataProperty('publicDownloads');
        $this->hiddenStringsProofreadersAccess = (bool)$this->getDataProperty('hiddenStringsProofreadersAccess');
        $this->useGlobalTm = (bool)$this->getDataProperty('useGlobalTm');
        $this->inContext = (bool)$this->getDataProperty('inContext');
        $this->inContextProcessHiddenStrings = (bool)$this->getDataProperty('inContextProcessHiddenStrings');
        $this->inContextPseudoLanguageId = (string)$this->getDataProperty('inContextPseudoLanguageId');
        $this->inContextPseudoLanguage = (array)$this->getDataProperty('inContextPseudoLanguage');
        $this->qaCheckIsActive = (bool)$this->getDataProperty('qaCheckIsActive');
        $this->qaCheckCategories = (array)$this->getDataProperty('qaCheckCategories');
        $this->customQaCheckIds = (array)$this->getDataProperty('customQaCheckIds');
        $this->languageMapping = (array)$this->getDataProperty('languageMapping');
        $this->glossaryAccess = (bool)$this->getDataProperty('glossaryAccess');
        $this->isSuspended = (bool)$this->getDataProperty('isSuspended');
        $this->normalizePlaceholder = (bool)$this->getDataProperty('normalizePlaceholder');
        $this->saveMetaInfoInSource = (bool)$this->getDataProperty('saveMetaInfoInSource');
        $this->notificationSettings = (array)$this->getDataProperty('notificationSettings');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     */
    public function setGroupId(int $groupId): void
    {
        $this->groupId = $groupId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getSourceLanguageId(): string
    {
        return $this->sourceLanguageId;
    }

    /**
     * @param string $sourceLanguageId
     */
    public function setSourceLanguageId(string $sourceLanguageId): void
    {
        $this->sourceLanguageId = $sourceLanguageId;
    }

    /**
     * @return array
     */
    public function getTargetLanguageIds(): array
    {
        return $this->targetLanguageIds;
    }

    /**
     * @param array $targetLanguageIds
     */
    public function setTargetLanguageIds(array $targetLanguageIds): void
    {
        $this->targetLanguageIds = $targetLanguageIds;
    }

    public function getTargetLanguages(): array
    {
        return $this->targetLanguages;
    }

    public function setTargetLanguages(array $targetLanguages): void
    {
        $this->targetLanguages = $targetLanguages;
    }

    /**
     * @return string
     */
    public function getLanguageAccessPolicy(): string
    {
        return $this->languageAccessPolicy;
    }

    /**
     * @param string $languageAccessPolicy
     */
    public function setLanguageAccessPolicy(string $languageAccessPolicy): void
    {
        $this->languageAccessPolicy = $languageAccessPolicy;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCname(): string
    {
        return $this->cname;
    }

    /**
     * @param string $cname
     */
    public function setCname(string $cname): void
    {
        $this->cname = $cname;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getVisibility(): string
    {
        return $this->visibility;
    }

    /**
     * @param string $visibility
     */
    public function setVisibility(string $visibility): void
    {
        $this->visibility = $visibility;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     */
    public function setLogo(string $logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @return string
     */
    public function getBackground(): string
    {
        return $this->background;
    }

    /**
     * @param string $background
     */
    public function setBackground(string $background): void
    {
        $this->background = $background;
    }

    /**
     * @return bool
     */
    public function isExternal(): bool
    {
        return $this->isExternal;
    }

    /**
     * @param bool $isExternal
     */
    public function setIsExternal(bool $isExternal): void
    {
        $this->isExternal = $isExternal;
    }

    /**
     * @return string
     */
    public function getExternalType(): string
    {
        return $this->externalType;
    }

    /**
     * @param string $externalType
     */
    public function setExternalType(string $externalType): void
    {
        $this->externalType = $externalType;
    }

    /**
     * @return int
     */
    public function getWorkflowId(): int
    {
        return $this->workflowId;
    }

    /**
     * @param int $workflowId
     */
    public function setWorkflowId(int $workflowId): void
    {
        $this->workflowId = $workflowId;
    }

    /**
     * @return bool
     */
    public function isHasCrowdsourcing(): bool
    {
        return $this->hasCrowdsourcing;
    }

    /**
     * @param bool $hasCrowdsourcing
     */
    public function setHasCrowdsourcing(bool $hasCrowdsourcing): void
    {
        $this->hasCrowdsourcing = $hasCrowdsourcing;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function getLastActivity(): string
    {
        return $this->lastActivity;
    }

    /**
     * @param string $lastActivity
     */
    public function setLastActivity(string $lastActivity): void
    {
        $this->lastActivity = $lastActivity;
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

    public function isExportTranslatedOnly(): bool
    {
        return $this->exportTranslatedOnly;
    }

    public function setExportTranslatedOnly(bool $exportTranslatedOnly): void
    {
        $this->exportTranslatedOnly = $exportTranslatedOnly;
    }

    /**
     * @return bool
     */
    public function isSkipUntranslatedStrings(): bool
    {
        return $this->skipUntranslatedStrings;
    }

    /**
     * @param bool $skipUntranslatedStrings
     */
    public function setSkipUntranslatedStrings(bool $skipUntranslatedStrings): void
    {
        $this->skipUntranslatedStrings = $skipUntranslatedStrings;
    }

    /**
     * @return bool
     */
    public function isSkipUntranslatedFiles(): bool
    {
        return $this->skipUntranslatedFiles;
    }

    /**
     * @param bool $skipUntranslatedFiles
     */
    public function setSkipUntranslatedFiles(bool $skipUntranslatedFiles): void
    {
        $this->skipUntranslatedFiles = $skipUntranslatedFiles;
    }

    /**
     * @return int
     */
    public function getExportWithMinApprovalsCount(): int
    {
        return $this->exportWithMinApprovalsCount;
    }

    /**
     * @param int $exportWithMinApprovalsCount
     */
    public function setExportWithMinApprovalsCount(int $exportWithMinApprovalsCount): void
    {
        $this->exportWithMinApprovalsCount = $exportWithMinApprovalsCount;
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
    public function isHiddenStringsProofreadersAccess(): bool
    {
        return $this->hiddenStringsProofreadersAccess;
    }

    /**
     * @param bool $hiddenStringsProofreadersAccess
     */
    public function setHiddenStringsProofreadersAccess(bool $hiddenStringsProofreadersAccess): void
    {
        $this->hiddenStringsProofreadersAccess = $hiddenStringsProofreadersAccess;
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
     * @return bool
     */
    public function isInContextProcessHiddenStrings(): bool
    {
        return $this->inContextProcessHiddenStrings;
    }

    /**
     * @param bool $inContextProcessHiddenStrings
     */
    public function setInContextProcessHiddenStrings(bool $inContextProcessHiddenStrings): void
    {
        $this->inContextProcessHiddenStrings = $inContextProcessHiddenStrings;
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

    /**
     * @return array|int[]
     */
    public function getCustomQaCheckIds(): array
    {
        return $this->customQaCheckIds;
    }

    /**
     * @param array $customQaCheckIds
     */
    public function setCustomQaCheckIds(array $customQaCheckIds): void
    {
        $this->customQaCheckIds = $customQaCheckIds;
    }

    /**
     * @return string
     */
    public function getInContextPseudoLanguageId(): ?string
    {
        return $this->inContextPseudoLanguageId;
    }

    /**
     * @param ?string $inContextPseudoLanguageId
     */
    public function setInContextPseudoLanguageId(?string $inContextPseudoLanguageId): void
    {
        $this->inContextPseudoLanguageId = $inContextPseudoLanguageId;
    }

    /**
     * @return array
     */
    public function getInContextPseudoLanguage(): array
    {
        return $this->inContextPseudoLanguage;
    }

    /**
     * @param array $inContextPseudoLanguage
     */
    public function setInContextPseudoLanguage(array $inContextPseudoLanguage): void
    {
        $this->inContextPseudoLanguage = $inContextPseudoLanguage;
    }

    /**
     * @return array
     */
    public function getLanguageMapping(): array
    {
        return $this->languageMapping;
    }

    /**
     * @param array $languageMapping
     */
    public function setLanguageMapping(array $languageMapping): void
    {
        $this->languageMapping = $languageMapping;
    }

    /**
     * @return bool
     */
    public function isGlossaryAccess(): bool
    {
        return $this->glossaryAccess;
    }

    /**
     * @param bool $glossaryAccess
     */
    public function setGlossaryAccess(bool $glossaryAccess): void
    {
        $this->glossaryAccess = $glossaryAccess;
    }

    /**
     * @return bool
     */
    public function isSuspended(): bool
    {
        return $this->isSuspended;
    }

    /**
     * @param bool $isSuspended
     */
    public function setIsSuspended(bool $isSuspended): void
    {
        $this->isSuspended = $isSuspended;
    }

    /**
     * @return bool
     */
    public function isNormalizePlaceholder(): bool
    {
        return $this->normalizePlaceholder;
    }

    /**
     * @param bool $normalizePlaceholder
     */
    public function setNormalizePlaceholder(bool $normalizePlaceholder): void
    {
        $this->normalizePlaceholder = $normalizePlaceholder;
    }

    /**
     * @return bool
     */
    public function isSaveMetaInfoInSource(): bool
    {
        return $this->saveMetaInfoInSource;
    }

    /**
     * @param bool $saveMetaInfoInSource
     */
    public function setSaveMetaInfoInSource(bool $saveMetaInfoInSource): void
    {
        $this->saveMetaInfoInSource = $saveMetaInfoInSource;
    }

    /**
     * @return array
     */
    public function getNotificationSettings(): array
    {
        return $this->notificationSettings;
    }

    /**
     * @param array $notificationSettings
     */
    public function setNotificationSettings(array $notificationSettings): void
    {
        $this->notificationSettings = $notificationSettings;
    }
}
