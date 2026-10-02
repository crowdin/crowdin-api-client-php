<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class User extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var bool
     */
    protected $emailVerified;

    /**
     * @var string
     */
    protected $fullName;

    /**
     * @var string
     */
    protected $avatarUrl;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $lastSeen;

    /**
     * @var string
     */
    protected $twoFactor;

    /**
     * @var string
     */
    protected $timezone;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->username = (string)$this->getDataProperty('username');
        $this->email = (string)$this->getDataProperty('email');
        $this->emailVerified = (bool)$this->getDataProperty('emailVerified');
        $this->fullName = (string)$this->getDataProperty('fullName');
        $this->avatarUrl = (string)$this->getDataProperty('avatarUrl');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->lastSeen = (string)$this->getDataProperty('lastSeen');
        $this->twoFactor = (string)$this->getDataProperty('twoFactor');
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

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getEmailVerified(): bool
    {
        return $this->emailVerified;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getLastSeen(): string
    {
        return $this->lastSeen;
    }

    public function getTwoFactor(): string
    {
        return $this->twoFactor;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }
}
