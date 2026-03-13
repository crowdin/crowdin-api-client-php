<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class ProjectMember extends BaseModel
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
    protected $fullName;

    /**
     * @var string
     */
    protected $role;

    /**
     * @var array
     */
    protected $permissions = [];

    /**
     * @var array
     */
    protected $roles;

    /**
     * @var string
     */
    protected $avatarUrl;

    /**
     * @var string
     */
    protected $joinedAt;

    /**
     * @var string
     */
    protected $timezone;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->username = (string)$this->getDataProperty('username');
        $this->fullName = (string)$this->getDataProperty('fullName');
        $this->role = (string)$this->getDataProperty('role');
        $this->permissions = (array)$this->getDataProperty('permissions');
        $this->roles = (array)$this->getDataProperty('roles');
        $this->avatarUrl = (string)$this->getDataProperty('avatarUrl');
        $this->joinedAt = (string)$this->getDataProperty('joinedAt');
        $this->timezone = (string)$this->getDataProperty('timezone');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    public function getJoinedAt(): string
    {
        return $this->joinedAt;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }
}
