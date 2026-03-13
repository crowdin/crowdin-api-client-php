<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

/**
 * @package Crowdin\Model\Enterprise
 */
class ProjectTeamMemberResource extends BaseModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var array
     */
    protected $roles;

    /**
     * @var bool
     */
    protected $isManager;

    /**
     * @var bool
     */
    protected $isDeveloper;

    /**
     * @var bool
     */
    protected $isAdmin;

    /**
     * @var array
     */
    protected $managerOfGroup = [];

    /**
     * @deprecated
     * @var bool
     */
    protected $accessToAllWorkflowSteps;

    /**
     * @deprecated
     * @var array
     */
    protected $permissions = [];

    /**
     * @var string
     */
    protected $givenAccessAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->username = (string)$this->getDataProperty('username');
        $this->firstName = (string)$this->getDataProperty('firstName');
        $this->lastName = (string)$this->getDataProperty('lastName');
        $this->roles = (array)$this->getDataProperty('roles');
        $this->isManager = (bool)$this->getDataProperty('isManager');
        $this->isDeveloper = (bool)$this->getDataProperty('isDeveloper');
        $this->isAdmin = (bool)$this->getDataProperty('isAdmin');
        $this->managerOfGroup = (array)$this->getDataProperty('managerOfGroup');
        $this->accessToAllWorkflowSteps = (bool)$this->getDataProperty('accessToAllWorkflowSteps');
        $this->permissions = (array)$this->getDataProperty('permissions');
        $this->givenAccessAt = (string)$this->getDataProperty('givenAccessAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function isDeveloper(): bool
    {
        return $this->isDeveloper;
    }

    public function isManager(): bool
    {
        return $this->isManager;
    }

    public function getManagerOfGroup(): array
    {
        return $this->managerOfGroup;
    }

    public function isAccessToAllWorkflowSteps(): bool
    {
        return $this->accessToAllWorkflowSteps;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function getGivenAccessAt(): string
    {
        return $this->givenAccessAt;
    }
}
