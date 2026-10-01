<?php

namespace CrowdinApiClient\Model;

/**
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
     * @var string|null
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
     * @var array
     */
    protected $qaChecksIgnorableCategories = [];

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
     * @var string|null
     */
    protected $glossaryAccessOption;

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

    /**
     * @var integer
     */
    protected $defaultTmId;

    /**
     * @var integer
     */
    protected $defaultGlossaryId;

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @var array|null
     */
    protected $aiPreTranslate;

    /**
     * @var int|null
     */
    protected $alignmentActionAiPromptId;

    /**
     * @var array|null
     */
    protected $assignedGlossaries;

    /**
     * @var array|null
     */
    protected $assignedStyleGuides;

    /**
     * @var array|null
     */
    protected $assignedTms;

    /**
     * @var int|null
     */
    protected $clientOrganizationId;

    /**
     * @var int|null
     */
    protected $contextReviewAiPromptId;

    /**
     * @var bool|null
     */
    protected $delayedWorkflowStart;

    /**
     * @var int|null
     */
    protected $editorSuggestionAiPromptId;

    /**
     * @var bool|null
     */
    protected $exportStringsThatPassedWorkflow;

    /**
     * @var int|null
     */
    protected $externalOrganizationId;

    /**
     * @var int|null
     */
    protected $externalProjectId;

    /**
     * @var array|null
     */
    protected $externalQaCheckIds;

    /**
     * @var array|null
     */
    protected $mtPreTranslate;

    /**
     * @var string|null
     */
    protected $publicUrl;

    /**
     * @var int|null
     */
    protected $qaApprovalsCount;

    /**
     * @var int|null
     */
    protected $qaCheckActionAiPromptId;

    /**
     * @var int
     */
    protected $savingsReportSettingsTemplateId;

    /**
     * @var bool|null
     */
    protected $showTmSuggestionsDialects;

    /**
     * @var array
     */
    protected $sourceLanguage;

    /**
     * @var int|null
     */
    protected $tagsDetection;

    /**
     * @var bool|null
     */
    protected $taskBasedAccessControl;

    /**
     * @var array|null
     */
    protected $taskReviewerIds;

    /**
     * @var bool|null
     */
    protected $tmApprovedSuggestionsOnly;

    /**
     * @var string|null
     */
    protected $tmContextType;

    /**
     * @var array|null
     */
    protected $tmPenalties;

    /**
     * @var array|null
     */
    protected $tmPreTranslate;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var string
     */
    protected $webUrl;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->groupId = (int)$this->getDataProperty('groupId');
        $this->userId = (int)$this->getDataProperty('userId');
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
        $this->workflowId = (int)$this->getDataProperty('workflowId');
        $this->hasCrowdsourcing = (bool)$this->getDataProperty('hasCrowdsourcing');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
        $this->lastActivity = (string)$this->getDataProperty('lastActivity');

        $this->translateDuplicates = (int)$this->getDataProperty('translateDuplicates');
        $this->isMtAllowed = (bool)$this->getDataProperty('isMtAllowed');
        $this->autoSubstitution = (bool)$this->getDataProperty('autoSubstitution');
        $this->skipUntranslatedStrings = (bool)$this->getDataProperty('skipUntranslatedStrings');
        $this->skipUntranslatedFiles = (bool)$this->getDataProperty('skipUntranslatedFiles');
        $this->exportWithMinApprovalsCount = (int)$this->getDataProperty('exportWithMinApprovalsCount');
        $this->exportApprovedOnly = (bool)$this->getDataProperty('exportApprovedOnly');
        $this->autoTranslateDialects = (bool)$this->getDataProperty('autoTranslateDialects');
        $this->publicDownloads = (bool)$this->getDataProperty('publicDownloads');
        $this->hiddenStringsProofreadersAccess = (bool)$this->getDataProperty('hiddenStringsProofreadersAccess');
        $this->useGlobalTm = (bool)$this->getDataProperty('useGlobalTm');
        $this->inContext = (bool)$this->getDataProperty('inContext');
        $this->inContextProcessHiddenStrings = (bool)$this->getDataProperty('inContextProcessHiddenStrings');
        $this->inContextPseudoLanguageId = $this->nullableString('inContextPseudoLanguageId');
        $this->inContextPseudoLanguage = (array)$this->getDataProperty('inContextPseudoLanguage');
        $this->qaCheckIsActive = (bool)$this->getDataProperty('qaCheckIsActive');
        $this->qaCheckCategories = (array)$this->getDataProperty('qaCheckCategories');
        $this->qaChecksIgnorableCategories = (array)$this->getDataProperty('qaChecksIgnorableCategories');
        $this->customQaCheckIds = (array)$this->getDataProperty('customQaCheckIds');
        $this->languageMapping = (array)$this->getDataProperty('languageMapping');
        $this->glossaryAccess = (bool)$this->getDataProperty('glossaryAccess');
        $this->exportTranslatedOnly = (bool)$this->getDataProperty('exportTranslatedOnly');
        $this->glossaryAccessOption = $this->nullableString('glossaryAccessOption');
        $this->isSuspended = (bool)$this->getDataProperty('isSuspended');
        $this->normalizePlaceholder = (bool)$this->getDataProperty('normalizePlaceholder');
        $this->saveMetaInfoInSource = (bool)$this->getDataProperty('saveMetaInfoInSource');
        $this->notificationSettings = (array)$this->getDataProperty('notificationSettings');
        $this->defaultTmId = (int)$this->getDataProperty('defaultTmId');
        $this->defaultGlossaryId = (int)$this->getDataProperty('defaultGlossaryId');
        $this->fields = (array)$this->getDataProperty('fields');
        $this->aiPreTranslate = $this->nullableArray('aiPreTranslate');
        $this->alignmentActionAiPromptId = $this->nullableInt('alignmentActionAiPromptId');
        $this->assignedGlossaries = $this->nullableArray('assignedGlossaries');
        $this->assignedStyleGuides = $this->nullableArray('assignedStyleGuides');
        $this->assignedTms = $this->nullableArray('assignedTms');
        $this->clientOrganizationId = $this->nullableInt('clientOrganizationId');
        $this->contextReviewAiPromptId = $this->nullableInt('contextReviewAiPromptId');
        $this->delayedWorkflowStart = $this->nullableBool('delayedWorkflowStart');
        $this->editorSuggestionAiPromptId = $this->nullableInt('editorSuggestionAiPromptId');
        $this->exportStringsThatPassedWorkflow = $this->nullableBool('exportStringsThatPassedWorkflow');
        $this->externalOrganizationId = $this->nullableInt('externalOrganizationId');
        $this->externalProjectId = $this->nullableInt('externalProjectId');
        $this->externalQaCheckIds = $this->nullableArray('externalQaCheckIds');
        $this->mtPreTranslate = $this->nullableArray('mtPreTranslate');
        $this->publicUrl = $this->nullableString('publicUrl');
        $this->qaApprovalsCount = $this->nullableInt('qaApprovalsCount');
        $this->qaCheckActionAiPromptId = $this->nullableInt('qaCheckActionAiPromptId');
        $this->savingsReportSettingsTemplateId = (int)$this->getDataProperty('savingsReportSettingsTemplateId');
        $this->showTmSuggestionsDialects = $this->nullableBool('showTmSuggestionsDialects');
        $this->sourceLanguage = (array)$this->getDataProperty('sourceLanguage');
        $this->tagsDetection = $this->nullableInt('tagsDetection');
        $this->taskBasedAccessControl = $this->nullableBool('taskBasedAccessControl');
        $this->taskReviewerIds = $this->nullableArray('taskReviewerIds');
        $this->tmApprovedSuggestionsOnly = $this->nullableBool('tmApprovedSuggestionsOnly');
        $this->tmContextType = $this->nullableString('tmContextType');
        $this->tmPenalties = $this->nullableArray('tmPenalties');
        $this->tmPreTranslate = $this->nullableArray('tmPreTranslate');
        $this->type = (int)$this->getDataProperty('type');
        $this->webUrl = (string)$this->getDataProperty('webUrl');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getGroupId(): int
    {
        return $this->groupId;
    }

    public function setGroupId(int $groupId): void
    {
        $this->groupId = $groupId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getSourceLanguageId(): string
    {
        return $this->sourceLanguageId;
    }

    public function setSourceLanguageId(string $sourceLanguageId): void
    {
        $this->sourceLanguageId = $sourceLanguageId;
    }

    public function getTargetLanguageIds(): array
    {
        return $this->targetLanguageIds;
    }

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

    public function getLanguageAccessPolicy(): string
    {
        return $this->languageAccessPolicy;
    }

    public function setLanguageAccessPolicy(string $languageAccessPolicy): void
    {
        $this->languageAccessPolicy = $languageAccessPolicy;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCname(): string
    {
        return $this->cname;
    }

    public function setCname(string $cname): void
    {
        $this->cname = $cname;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getVisibility(): string
    {
        return $this->visibility;
    }

    public function setVisibility(string $visibility): void
    {
        $this->visibility = $visibility;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @deprecated Deprecated by the Crowdin Enterprise API.
     * @return string
     */
    public function getBackground(): string
    {
        return $this->background;
    }

    /**
     * @deprecated Deprecated by the Crowdin Enterprise API.
     * @param string $background
     */
    public function setBackground(string $background): void
    {
        $this->background = $background;
    }

    public function isExternal(): bool
    {
        return $this->isExternal;
    }

    public function setIsExternal(bool $isExternal): void
    {
        $this->isExternal = $isExternal;
    }

    public function getExternalType(): string
    {
        return $this->externalType;
    }

    public function setExternalType(string $externalType): void
    {
        $this->externalType = $externalType;
    }

    public function getWorkflowId(): int
    {
        return $this->workflowId;
    }

    public function setWorkflowId(int $workflowId): void
    {
        $this->workflowId = $workflowId;
    }

    public function isHasCrowdsourcing(): bool
    {
        return $this->hasCrowdsourcing;
    }

    public function setHasCrowdsourcing(bool $hasCrowdsourcing): void
    {
        $this->hasCrowdsourcing = $hasCrowdsourcing;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getLastActivity(): string
    {
        return $this->lastActivity;
    }

    public function setLastActivity(string $lastActivity): void
    {
        $this->lastActivity = $lastActivity;
    }

    public function getTranslateDuplicates(): int
    {
        return $this->translateDuplicates;
    }

    public function setTranslateDuplicates(int $translateDuplicates): void
    {
        $this->translateDuplicates = $translateDuplicates;
    }

    public function isMtAllowed(): bool
    {
        return $this->isMtAllowed;
    }

    public function setIsMtAllowed(bool $isMtAllowed): void
    {
        $this->isMtAllowed = $isMtAllowed;
    }

    public function isAutoSubstitution(): bool
    {
        return $this->autoSubstitution;
    }

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

    public function isSkipUntranslatedStrings(): bool
    {
        return $this->skipUntranslatedStrings;
    }

    public function setSkipUntranslatedStrings(bool $skipUntranslatedStrings): void
    {
        $this->skipUntranslatedStrings = $skipUntranslatedStrings;
    }

    public function isSkipUntranslatedFiles(): bool
    {
        return $this->skipUntranslatedFiles;
    }

    public function setSkipUntranslatedFiles(bool $skipUntranslatedFiles): void
    {
        $this->skipUntranslatedFiles = $skipUntranslatedFiles;
    }

    public function getExportWithMinApprovalsCount(): int
    {
        return $this->exportWithMinApprovalsCount;
    }

    public function setExportWithMinApprovalsCount(int $exportWithMinApprovalsCount): void
    {
        $this->exportWithMinApprovalsCount = $exportWithMinApprovalsCount;
    }

    public function isExportApprovedOnly(): bool
    {
        return $this->exportApprovedOnly;
    }

    public function setExportApprovedOnly(bool $exportApprovedOnly): void
    {
        $this->exportApprovedOnly = $exportApprovedOnly;
    }

    public function isAutoTranslateDialects(): bool
    {
        return $this->autoTranslateDialects;
    }

    public function setAutoTranslateDialects(bool $autoTranslateDialects): void
    {
        $this->autoTranslateDialects = $autoTranslateDialects;
    }

    public function isPublicDownloads(): bool
    {
        return $this->publicDownloads;
    }

    public function setPublicDownloads(bool $publicDownloads): void
    {
        $this->publicDownloads = $publicDownloads;
    }

    public function isHiddenStringsProofreadersAccess(): bool
    {
        return $this->hiddenStringsProofreadersAccess;
    }

    public function setHiddenStringsProofreadersAccess(bool $hiddenStringsProofreadersAccess): void
    {
        $this->hiddenStringsProofreadersAccess = $hiddenStringsProofreadersAccess;
    }

    public function isUseGlobalTm(): bool
    {
        return $this->useGlobalTm;
    }

    public function setUseGlobalTm(bool $useGlobalTm): void
    {
        $this->useGlobalTm = $useGlobalTm;
    }

    public function isInContext(): bool
    {
        return $this->inContext;
    }

    public function setInContext(bool $inContext): void
    {
        $this->inContext = $inContext;
    }

    public function isInContextProcessHiddenStrings(): bool
    {
        return $this->inContextProcessHiddenStrings;
    }

    public function setInContextProcessHiddenStrings(bool $inContextProcessHiddenStrings): void
    {
        $this->inContextProcessHiddenStrings = $inContextProcessHiddenStrings;
    }

    public function isQaCheckIsActive(): bool
    {
        return $this->qaCheckIsActive;
    }

    public function setQaCheckIsActive(bool $qaCheckIsActive): void
    {
        $this->qaCheckIsActive = $qaCheckIsActive;
    }

    public function getQaCheckCategories(): array
    {
        return $this->qaCheckCategories;
    }

    public function setQaCheckCategories(array $qaCheckCategories): void
    {
        $this->qaCheckCategories = $qaCheckCategories;
    }

    public function getQaChecksIgnorableCategories(): array
    {
        return $this->qaChecksIgnorableCategories;
    }

    public function setQaChecksIgnorableCategories(array $qaChecksIgnorableCategories): void
    {
        $this->qaChecksIgnorableCategories = $qaChecksIgnorableCategories;
    }

    /**
     * @return array|int[]
     */
    public function getCustomQaCheckIds(): array
    {
        return $this->customQaCheckIds;
    }

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

    public function setInContextPseudoLanguageId(?string $inContextPseudoLanguageId): void
    {
        $this->inContextPseudoLanguageId = $inContextPseudoLanguageId;
    }

    public function getInContextPseudoLanguage(): array
    {
        return $this->inContextPseudoLanguage;
    }

    public function setInContextPseudoLanguage(array $inContextPseudoLanguage): void
    {
        $this->inContextPseudoLanguage = $inContextPseudoLanguage;
    }

    public function getLanguageMapping(): array
    {
        return $this->languageMapping;
    }

    public function setLanguageMapping(array $languageMapping): void
    {
        $this->languageMapping = $languageMapping;
    }

    /**
     * @deprecated Deprecated by the Crowdin API. Use getGlossaryAccessOption() instead.
     * @return bool
     */
    public function isGlossaryAccess(): bool
    {
        return $this->glossaryAccess;
    }

    /**
     * @deprecated Deprecated by the Crowdin API. Use setGlossaryAccessOption() instead.
     * @param bool $glossaryAccess
     */
    public function setGlossaryAccess(bool $glossaryAccess): void
    {
        $this->glossaryAccess = $glossaryAccess;
    }

    /**
     * @return string|null readOnly, fullAccess or manageDrafts
     */
    public function getGlossaryAccessOption(): ?string
    {
        return $this->glossaryAccessOption;
    }

    /**
     * @param string $glossaryAccessOption readOnly, fullAccess or manageDrafts
     */
    public function setGlossaryAccessOption(string $glossaryAccessOption): void
    {
        $this->glossaryAccessOption = $glossaryAccessOption;
    }

    public function isSuspended(): bool
    {
        return $this->isSuspended;
    }

    public function setIsSuspended(bool $isSuspended): void
    {
        $this->isSuspended = $isSuspended;
    }

    public function isNormalizePlaceholder(): bool
    {
        return $this->normalizePlaceholder;
    }

    public function setNormalizePlaceholder(bool $normalizePlaceholder): void
    {
        $this->normalizePlaceholder = $normalizePlaceholder;
    }

    public function isSaveMetaInfoInSource(): bool
    {
        return $this->saveMetaInfoInSource;
    }

    public function setSaveMetaInfoInSource(bool $saveMetaInfoInSource): void
    {
        $this->saveMetaInfoInSource = $saveMetaInfoInSource;
    }

    public function getNotificationSettings(): array
    {
        return $this->notificationSettings;
    }

    public function setNotificationSettings(array $notificationSettings): void
    {
        $this->notificationSettings = $notificationSettings;
    }

    public function getDefaultTmId(): ?int
    {
        return $this->defaultTmId;
    }

    public function setDefaultTmId(?int $defaultTmId): void
    {
        $this->defaultTmId = $defaultTmId;
    }

    public function getDefaultGlossaryId(): ?int
    {
        return $this->defaultGlossaryId;
    }

    public function setDefaultGlossaryId(?int $defaultGlossaryId): void
    {
        $this->defaultGlossaryId = $defaultGlossaryId;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

    public function getAiPreTranslate(): ?array
    {
        return $this->aiPreTranslate;
    }

    public function setAiPreTranslate(array $aiPreTranslate): void
    {
        $this->aiPreTranslate = $aiPreTranslate;
    }

    public function getAlignmentActionAiPromptId(): ?int
    {
        return $this->alignmentActionAiPromptId;
    }

    public function setAlignmentActionAiPromptId(int $alignmentActionAiPromptId): void
    {
        $this->alignmentActionAiPromptId = $alignmentActionAiPromptId;
    }

    public function getAssignedGlossaries(): ?array
    {
        return $this->assignedGlossaries;
    }

    public function setAssignedGlossaries(array $assignedGlossaries): void
    {
        $this->assignedGlossaries = $assignedGlossaries;
    }

    public function getAssignedStyleGuides(): ?array
    {
        return $this->assignedStyleGuides;
    }

    public function setAssignedStyleGuides(array $assignedStyleGuides): void
    {
        $this->assignedStyleGuides = $assignedStyleGuides;
    }

    public function getAssignedTms(): ?array
    {
        return $this->assignedTms;
    }

    public function setAssignedTms(array $assignedTms): void
    {
        $this->assignedTms = $assignedTms;
    }

    public function getClientOrganizationId(): ?int
    {
        return $this->clientOrganizationId;
    }

    public function getContextReviewAiPromptId(): ?int
    {
        return $this->contextReviewAiPromptId;
    }

    public function setContextReviewAiPromptId(int $contextReviewAiPromptId): void
    {
        $this->contextReviewAiPromptId = $contextReviewAiPromptId;
    }

    public function isDelayedWorkflowStart(): ?bool
    {
        return $this->delayedWorkflowStart;
    }

    public function getEditorSuggestionAiPromptId(): ?int
    {
        return $this->editorSuggestionAiPromptId;
    }

    public function setEditorSuggestionAiPromptId(int $editorSuggestionAiPromptId): void
    {
        $this->editorSuggestionAiPromptId = $editorSuggestionAiPromptId;
    }

    public function isExportStringsThatPassedWorkflow(): ?bool
    {
        return $this->exportStringsThatPassedWorkflow;
    }

    public function setExportStringsThatPassedWorkflow(bool $exportStringsThatPassedWorkflow): void
    {
        $this->exportStringsThatPassedWorkflow = $exportStringsThatPassedWorkflow;
    }

    public function getExternalOrganizationId(): ?int
    {
        return $this->externalOrganizationId;
    }

    public function getExternalProjectId(): ?int
    {
        return $this->externalProjectId;
    }

    public function getExternalQaCheckIds(): ?array
    {
        return $this->externalQaCheckIds;
    }

    public function getMtPreTranslate(): ?array
    {
        return $this->mtPreTranslate;
    }

    public function setMtPreTranslate(array $mtPreTranslate): void
    {
        $this->mtPreTranslate = $mtPreTranslate;
    }

    public function getPublicUrl(): ?string
    {
        return $this->publicUrl;
    }

    public function getQaApprovalsCount(): ?int
    {
        return $this->qaApprovalsCount;
    }

    public function setQaApprovalsCount(int $qaApprovalsCount): void
    {
        $this->qaApprovalsCount = $qaApprovalsCount;
    }

    public function getQaCheckActionAiPromptId(): ?int
    {
        return $this->qaCheckActionAiPromptId;
    }

    public function setQaCheckActionAiPromptId(int $qaCheckActionAiPromptId): void
    {
        $this->qaCheckActionAiPromptId = $qaCheckActionAiPromptId;
    }

    public function getSavingsReportSettingsTemplateId(): int
    {
        return $this->savingsReportSettingsTemplateId;
    }

    public function setSavingsReportSettingsTemplateId(int $savingsReportSettingsTemplateId): void
    {
        $this->savingsReportSettingsTemplateId = $savingsReportSettingsTemplateId;
    }

    public function isShowTmSuggestionsDialects(): ?bool
    {
        return $this->showTmSuggestionsDialects;
    }

    public function setShowTmSuggestionsDialects(bool $showTmSuggestionsDialects): void
    {
        $this->showTmSuggestionsDialects = $showTmSuggestionsDialects;
    }

    public function getSourceLanguage(): array
    {
        return $this->sourceLanguage;
    }

    public function getTagsDetection(): ?int
    {
        return $this->tagsDetection;
    }

    public function isTaskBasedAccessControl(): ?bool
    {
        return $this->taskBasedAccessControl;
    }

    public function setTaskBasedAccessControl(bool $taskBasedAccessControl): void
    {
        $this->taskBasedAccessControl = $taskBasedAccessControl;
    }

    public function getTaskReviewerIds(): ?array
    {
        return $this->taskReviewerIds;
    }

    public function setTaskReviewerIds(array $taskReviewerIds): void
    {
        $this->taskReviewerIds = $taskReviewerIds;
    }

    public function isTmApprovedSuggestionsOnly(): ?bool
    {
        return $this->tmApprovedSuggestionsOnly;
    }

    public function setTmApprovedSuggestionsOnly(bool $tmApprovedSuggestionsOnly): void
    {
        $this->tmApprovedSuggestionsOnly = $tmApprovedSuggestionsOnly;
    }

    public function getTmContextType(): ?string
    {
        return $this->tmContextType;
    }

    public function setTmContextType(string $tmContextType): void
    {
        $this->tmContextType = $tmContextType;
    }

    public function getTmPenalties(): ?array
    {
        return $this->tmPenalties;
    }

    public function getTmPreTranslate(): ?array
    {
        return $this->tmPreTranslate;
    }

    public function setTmPreTranslate(array $tmPreTranslate): void
    {
        $this->tmPreTranslate = $tmPreTranslate;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }
}
