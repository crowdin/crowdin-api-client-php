<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * Diff between the installed application and its latest cached manifest.
 */
class ApplicationInstallationUpdate extends BaseModel
{
    /** @var string|null */
    protected $manifestHash;

    /** @var array|null */
    protected $latestManifest;

    /** @var array */
    protected $addedScopes;

    /** @var array */
    protected $removedScopes;

    /** @var array */
    protected $addedModules;

    /** @var array */
    protected $removedModules;

    /** @var array */
    protected $changedModules;

    /** @var array */
    protected $changedEvents;

    /** @var array */
    protected $baseUrlChanged;

    /** @var array */
    protected $authenticationTypeChanged;

    /** @var bool */
    protected $hasChanges;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->manifestHash = $this->nullableString('manifestHash');
        $this->latestManifest = $this->nullableArray('latestManifest');
        $this->addedScopes = (array)$this->getDataProperty('addedScopes');
        $this->removedScopes = (array)$this->getDataProperty('removedScopes');
        $this->addedModules = (array)$this->getDataProperty('addedModules');
        $this->removedModules = (array)$this->getDataProperty('removedModules');
        $this->changedModules = (array)$this->getDataProperty('changedModules');
        $this->changedEvents = (array)$this->getDataProperty('changedEvents');
        $this->baseUrlChanged = (array)$this->getDataProperty('baseUrlChanged');
        $this->authenticationTypeChanged = (array)$this->getDataProperty('authenticationTypeChanged');
        $this->hasChanges = (bool)$this->getDataProperty('hasChanges');
    }

    /**
     * Pass to ApplicationApi::applyInstallationUpdate() as an optimistic-locking token.
     */
    public function getManifestHash(): ?string
    {
        return $this->manifestHash;
    }

    public function getLatestManifest(): ?array
    {
        return $this->latestManifest;
    }

    public function getAddedScopes(): array
    {
        return $this->addedScopes;
    }

    public function getRemovedScopes(): array
    {
        return $this->removedScopes;
    }

    public function getAddedModules(): array
    {
        return $this->addedModules;
    }

    public function getRemovedModules(): array
    {
        return $this->removedModules;
    }

    public function getChangedModules(): array
    {
        return $this->changedModules;
    }

    /**
     * @return array event name => [from, to]
     */
    public function getChangedEvents(): array
    {
        return $this->changedEvents;
    }

    /**
     * @return array from, to
     */
    public function getBaseUrlChanged(): array
    {
        return $this->baseUrlChanged;
    }

    /**
     * @return array from, to
     */
    public function getAuthenticationTypeChanged(): array
    {
        return $this->authenticationTypeChanged;
    }

    public function hasChanges(): bool
    {
        return $this->hasChanges;
    }
}
