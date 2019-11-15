<?php

namespace CrowdinApiClient\Model;

/**
 * Class User
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
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $status;

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
     * @var bool
     */
    protected $isAdmin;

    /**
     * @var string
     */
    protected $timezone;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (integer)$this->getDataProperty('id');
        $this->username = (string)$this->getDataProperty('username');
        $this->email = (string)$this->getDataProperty('email');
        $this->firstName = (string)$this->getDataProperty('firstName');
        $this->lastName = (string)$this->getDataProperty('lastName');
        $this->status = (string)$this->getDataProperty('status');
        $this->avatarUrl = (string)$this->getDataProperty('avatarUrl');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->lastSeen = (string)$this->getDataProperty('lastSeen');
        $this->twoFactor = (string)$this->getDataProperty('twoFactor');
        $this->isAdmin = (bool)$this->getDataProperty('isAdmin');
        $this->timezone = (string)$this->getDataProperty('timezone');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    /**
     * @param string $avatarUrl
     */
    public function setAvatarUrl(string $avatarUrl): void
    {
        $this->avatarUrl = $avatarUrl;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getLastSeen(): string
    {
        return $this->lastSeen;
    }

    /**
     * @param string $lastSeen
     */
    public function setLastSeen(string $lastSeen): void
    {
        $this->lastSeen = $lastSeen;
    }

    /**
     * @return string
     */
    public function getTwoFactor(): string
    {
        return $this->twoFactor;
    }

    /**
     * @param string $twoFactor
     */
    public function setTwoFactor(string $twoFactor): void
    {
        $this->twoFactor = $twoFactor;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    /**
     * @param bool $isAdmin
     */
    public function setIsAdmin(bool $isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }

    /**
     * @return string
     */
    public function getTimezone(): string
    {
        return $this->timezone;
    }

    /**
     * @param string $timezone
     */
    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }
}
