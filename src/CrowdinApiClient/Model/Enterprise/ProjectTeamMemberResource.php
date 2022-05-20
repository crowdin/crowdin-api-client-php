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
     * @var bool
     */
    protected $isManager;

    /**
     * @var bool
     */
    protected $managerAccess;

    /**
     * @var array
     */
    protected $managerOfGroup = [];

    /**
     * @var bool
     */
    protected $accessToAllWorkflowSteps;

    /**
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
        $this->isManager = (bool)$this->getDataProperty('isManager');
        $this->managerOfGroup = (array)$this->getDataProperty('managerOfGroup');
        $this->accessToAllWorkflowSteps = (bool)$this->getDataProperty('accessToAllWorkflowSteps');
        $this->permissions = (array)$this->getDataProperty('permissions');
        $this->givenAccessAt = (string)$this->getDataProperty('givenAccessAt');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return bool
     */
    public function isManager(): bool
    {
        return $this->isManager;
    }

    /**
     * @return array
     */
    public function getManagerOfGroup(): array
    {
        return $this->managerOfGroup;
    }

    /**
     * @return bool
     */
    public function isAccessToAllWorkflowSteps(): bool
    {
        return $this->accessToAllWorkflowSteps;
    }

    /**
     * @param bool $accessToAllWorkflowSteps
     */
    public function setAccessToAllWorkflowSteps(bool $accessToAllWorkflowSteps): void
    {
        $this->accessToAllWorkflowSteps = $accessToAllWorkflowSteps;
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    /**
     * @param array $permissions
     */
    public function setPermissions(array $permissions): void
    {
        $this->permissions = $permissions;
    }

    /**
     * @return string
     */
    public function getGivenAccessAt(): string
    {
        return $this->givenAccessAt;
    }

    /**
     * @param bool $managerAccess
     */
    public function setManagerAccess(bool $managerAccess): void
    {
        $this->managerAccess = $managerAccess;
    }
}
