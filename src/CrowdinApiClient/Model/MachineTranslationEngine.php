<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class MachineTranslationEngine extends BaseModel
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
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $credentials;

    /**
     * @var array
     */
    protected $projectIds;

    /**
     * @var array|null
     */
    protected $enabledLanguageIds;

    /**
     * @var array|null
     */
    protected $enabledProjectIds;

    /**
     * @var bool|null
     */
    protected $isEnabled;

    /**
     * @var array
     */
    protected $supportedLanguageIds;

    /**
     * @var array|null
     */
    protected $supportedLanguagePairs;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->groupId = (int)$this->getDataProperty('groupId');
        $this->name = (string)$this->getDataProperty('name');
        $this->type = (string)$this->getDataProperty('type');
        $this->credentials = (array)$this->getDataProperty('credentials');
        $this->projectIds = (array)$this->getDataProperty('projectIds');
        $this->enabledLanguageIds = $this->nullableArray('enabledLanguageIds');
        $this->enabledProjectIds = $this->nullableArray('enabledProjectIds');
        $this->isEnabled = $this->nullableBool('isEnabled');
        $this->supportedLanguageIds = (array)$this->getDataProperty('supportedLanguageIds');
        $this->supportedLanguagePairs = $this->nullableArray('supportedLanguagePairs');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getCredentials(): array
    {
        return $this->credentials;
    }

    /**
     * @param array $credentials
     */
    public function setCredentials(array $credentials): void
    {
        $this->credentials = $credentials;
    }

    /**
     * @return array
     */
    public function getProjectIds(): array
    {
        return $this->projectIds;
    }

    public function getEnabledLanguageIds(): ?array
    {
        return $this->enabledLanguageIds;
    }

    public function setEnabledLanguageIds(array $enabledLanguageIds): void
    {
        $this->enabledLanguageIds = $enabledLanguageIds;
    }

    public function getEnabledProjectIds(): ?array
    {
        return $this->enabledProjectIds;
    }

    public function setEnabledProjectIds(array $enabledProjectIds): void
    {
        $this->enabledProjectIds = $enabledProjectIds;
    }

    public function isEnabled(): ?bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(bool $isEnabled): void
    {
        $this->isEnabled = $isEnabled;
    }

    public function getSupportedLanguageIds(): array
    {
        return $this->supportedLanguageIds;
    }

    public function getSupportedLanguagePairs(): ?array
    {
        return $this->supportedLanguagePairs;
    }
}
