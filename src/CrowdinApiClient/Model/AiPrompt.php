<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class AiPrompt extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $action;

    /** @var int|null */
    protected $aiProviderId;

    /** @var string|null */
    protected $aiModelId;

    /** @var bool */
    protected $isEnabled;

    /** @var int[] */
    protected $enabledProjectIds;

    /** @var array */
    protected $config;

    /** @var string|null */
    protected $promptPreview;

    /** @var bool */
    protected $isFineTuningAvailable;

    /** @var int|null */
    protected $createdBy;

    /** @var int|null */
    protected $updatedBy;

    /** @var int|null */
    protected $lastUsedBy;

    /** @var string|null */
    protected $lastUsedAt;

    /** @var int */
    protected $usageCount;

    /** @var string */
    protected $createdAt;

    /** @var string */
    protected $updatedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->action = (string)$this->getDataProperty('action');
        $this->aiProviderId = $this->getDataProperty('aiProviderId');
        $this->aiModelId = $this->getDataProperty('aiModelId');
        $this->isEnabled = (bool)$this->getDataProperty('isEnabled');
        $this->enabledProjectIds = (array)$this->getDataProperty('enabledProjectIds');
        $this->config = (array)$this->getDataProperty('config');
        $this->promptPreview = $this->getDataProperty('promptPreview');
        $this->isFineTuningAvailable = (bool)$this->getDataProperty('isFineTuningAvailable');
        $this->createdBy = $this->getDataProperty('createdBy');
        $this->updatedBy = $this->getDataProperty('updatedBy');
        $this->lastUsedBy = $this->getDataProperty('lastUsedBy');
        $this->lastUsedAt = $this->getDataProperty('lastUsedAt');
        $this->usageCount = (int)$this->getDataProperty('usageCount');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getAiProviderId(): ?int
    {
        return $this->aiProviderId;
    }

    public function getAiModelId(): ?string
    {
        return $this->aiModelId;
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function getEnabledProjectIds(): array
    {
        return $this->enabledProjectIds;
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function getPromptPreview(): ?string
    {
        return $this->promptPreview;
    }

    public function isFineTuningAvailable(): bool
    {
        return $this->isFineTuningAvailable;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }

    public function getLastUsedBy(): ?int
    {
        return $this->lastUsedBy;
    }

    public function getLastUsedAt(): ?string
    {
        return $this->lastUsedAt;
    }

    public function getUsageCount(): int
    {
        return $this->usageCount;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function setAiProviderId(?int $aiProviderId): void
    {
        $this->aiProviderId = $aiProviderId;
    }

    public function setAiModelId(?string $aiModelId): void
    {
        $this->aiModelId = $aiModelId;
    }

    public function setEnabledProjectIds(array $enabledProjectIds): void
    {
        $this->enabledProjectIds = $enabledProjectIds;
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
    }
}
