<?php

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

/**
 * @package Crowdin\Model\Enterprise
 */
class ProjectTeam extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    protected $hasManagerAccess = false;

    /**
     * @var boolean
     */
    protected $hasDeveloperAccess = false;

    /**
     * @var boolean
     */
    protected $hasAccessToAllWorkflowSteps = false;

    /**
     * @var array
     */
    protected $permissions;

    /**
     * @var array
     */
    protected $roles;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->hasManagerAccess = (bool)$this->getDataProperty('hasManagerAccess');
        $this->hasDeveloperAccess = (bool)$this->getDataProperty('hasDeveloperAccess');
        $this->hasAccessToAllWorkflowSteps = (bool)$this->getDataProperty('hasAccessToAllWorkflowSteps');
        $this->permissions = (array)$this->getDataProperty('permissions');
        $this->roles = (array)$this->getDataProperty('roles');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getHasManagerAccess(): bool
    {
        return $this->hasManagerAccess;
    }

    public function setHasManagerAccess(bool $hasManagerAccess): void
    {
        $this->hasManagerAccess = $hasManagerAccess;
    }

    public function getHasAccessToAllWorkflowSteps(): bool
    {
        return $this->hasAccessToAllWorkflowSteps;
    }

    public function setHasAccessToAllWorkflowSteps(bool $hasAccessToAllWorkflowSteps): void
    {
        $this->hasAccessToAllWorkflowSteps = $hasAccessToAllWorkflowSteps;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function setPermissions(array $permissions): void
    {
        $this->permissions = $permissions;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHasDeveloperAccess(): bool
    {
        return $this->hasDeveloperAccess;
    }

    /**
     * @return array List of roles: name and permissions (allLanguages, languagesAccess)
     */
    public function getRoles(): array
    {
        return $this->roles;
    }
}
