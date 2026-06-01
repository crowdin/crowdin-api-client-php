<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class ApplicationInstallation extends BaseModel
{
    /** @var string */
    protected $identifier;

    /** @var string */
    protected $name;

    /** @var array|null */
    protected $installedBy = null;

    /** @var string|null */
    protected $description = null;

    /** @var string */
    protected $logo;

    /** @var array|null */
    protected $agent = null;

    /** @var string */
    protected $baseUrl;

    /** @var string */
    protected $manifestUrl;

    /** @var string|null */
    protected $createdAt = null;

    /** @var array */
    protected $modules = [];

    /** @var array */
    protected $scopes = [];

    /** @var array */
    protected $permissions = [];

    /** @var array */
    protected $defaultPermissions = [];

    /** @var bool */
    protected $limitReached;

    /** @var bool */
    protected $stringBasedAvailable;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->identifier = (string)$this->getDataProperty('identifier');
        $this->name = (string)$this->getDataProperty('name');
        $this->installedBy = $this->getDataProperty('installedBy');
        $this->description = $this->getDataProperty('description');
        $this->logo = (string)$this->getDataProperty('logo');
        $this->agent = $this->getDataProperty('agent');
        $this->baseUrl = (string)$this->getDataProperty('baseUrl');
        $this->manifestUrl = (string)$this->getDataProperty('manifestUrl');
        $this->createdAt = $this->getDataProperty('createdAt');
        $this->modules = (array)$this->getDataProperty('modules');
        $this->scopes = (array)$this->getDataProperty('scopes');
        $this->permissions = (array)$this->getDataProperty('permissions');
        $this->defaultPermissions = (array)$this->getDataProperty('defaultPermissions');
        $this->limitReached = (bool)$this->getDataProperty('limitReached');
        $this->stringBasedAvailable = (bool)$this->getDataProperty('stringBasedAvailable');
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array|null
     */
    public function getInstalledBy(): ?array
    {
        return $this->installedBy;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @return array|null
     */
    public function getAgent(): ?array
    {
        return $this->agent;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getManifestUrl(): string
    {
        return $this->manifestUrl;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getModules(): array
    {
        return $this->modules;
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function getDefaultPermissions(): array
    {
        return $this->defaultPermissions;
    }

    public function isLimitReached(): bool
    {
        return $this->limitReached;
    }

    public function isStringBasedAvailable(): bool
    {
        return $this->stringBasedAvailable;
    }

    public function setPermissions(array $permissions): void
    {
        $this->permissions = $permissions;
    }

    public function setModules(array $modules): void
    {
        $this->modules = $modules;
    }
}
