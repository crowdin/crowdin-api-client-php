<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class AiProvider extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $type;

    /** @var array|null */
    protected $credentials;

    /** @var array */
    protected $config;

    /** @var bool */
    protected $isEnabled;

    /** @var bool */
    protected $useSystemCredentials;

    /** @var string */
    protected $createdAt;

    /** @var string */
    protected $updatedAt;

    /** @var int */
    protected $promptsCount;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->type = (string)$this->getDataProperty('type');
        $this->credentials = $this->getDataProperty('credentials');
        $this->config = (array)$this->getDataProperty('config');
        $this->isEnabled = (bool)$this->getDataProperty('isEnabled');
        $this->useSystemCredentials = (bool)$this->getDataProperty('useSystemCredentials');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
        $this->promptsCount = (int)$this->getDataProperty('promptsCount');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCredentials(): ?array
    {
        return $this->credentials;
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function isUseSystemCredentials(): bool
    {
        return $this->useSystemCredentials;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getPromptsCount(): int
    {
        return $this->promptsCount;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setCredentials(?array $credentials): void
    {
        $this->credentials = $credentials;
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
    }

    public function setIsEnabled(bool $isEnabled): void
    {
        $this->isEnabled = $isEnabled;
    }

    public function setUseSystemCredentials(bool $useSystemCredentials): void
    {
        $this->useSystemCredentials = $useSystemCredentials;
    }
}
