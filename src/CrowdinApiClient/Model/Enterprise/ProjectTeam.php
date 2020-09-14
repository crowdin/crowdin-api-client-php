<?php

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

class ProjectTeam extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var boolean
     */
    protected $hasManagerAccess = false;

    /**
     * @var boolean
     */
    protected $hasAccessToAllWorkflowSteps = false;

    /**
     * @var array
     */
    protected $permissions;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->hasManagerAccess = (bool)$this->getDataProperty('hasManagerAccess');
        $this->hasAccessToAllWorkflowSteps = (bool)$this->getDataProperty('hasAccessToAllWorkflowSteps');
        $this->permissions = (array)$this->getDataProperty('permissions');
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
}
