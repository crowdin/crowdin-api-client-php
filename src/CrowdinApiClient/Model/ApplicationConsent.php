<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class ApplicationConsent extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var array|null */
    protected $installedBy;

    /** @var string */
    protected $identifier;

    /** @var string|null */
    protected $name;

    /** @var string */
    protected $status;

    /** @var array */
    protected $scopes;

    /** @var string */
    protected $createdAt;

    /** @var string */
    protected $updatedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->installedBy = $this->getDataProperty('installedBy');
        $this->identifier = (string)$this->getDataProperty('identifier');
        $this->name = $this->getDataProperty('name');
        $this->status = (string)$this->getDataProperty('status');
        $this->scopes = (array)$this->getDataProperty('scopes');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array|null
     */
    public function getInstalledBy(): ?array
    {
        return $this->installedBy;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setScopes(array $scopes): void
    {
        $this->scopes = $scopes;
    }
}
