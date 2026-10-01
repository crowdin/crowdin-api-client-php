<?php

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

/**
 * @package Crowdin\Model\Enterprise
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

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @var bool
     */
    protected $emailVerified;

    /**
     * @var array
     */
    protected $joinDetails;

    /**
     * @var string
     */
    protected $deviceVerification;

    /**
     * @var int
     */
    protected $trustedDevicesCount;

    /**
     * @var int
     */
    protected $apiTokensCount;

    /**
     * @var string[]
     */
    protected $loginMethods;

    /**
     * @var string[]
     */
    protected $mfaMethods;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->username = (string)$this->getDataProperty('username');
        $this->firstName = (string)$this->getDataProperty('firstName');
        $this->lastName = (string)$this->getDataProperty('lastName');
        $this->avatarUrl = (string)$this->getDataProperty('avatarUrl');
        $this->fields = (array)$this->getDataProperty('fields');
        $this->isAdmin = (bool)$this->getDataProperty('isAdmin');
        $this->status = (string)$this->getDataProperty('status');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->lastSeen = (string)$this->getDataProperty('lastSeen');

        // This information is only available for admins
        $this->email = (string)$this->getDataProperty('email');
        $this->emailVerified = (bool)$this->getDataProperty('emailVerified');
        $this->twoFactor = (string)$this->getDataProperty('twoFactor');
        $this->timezone = (string)$this->getDataProperty('timezone');
        $this->joinDetails = (array)$this->getDataProperty('joinDetails');
        $this->deviceVerification = (string)$this->getDataProperty('deviceVerification');
        $this->trustedDevicesCount = (int)$this->getDataProperty('trustedDevicesCount');
        $this->apiTokensCount = (int)$this->getDataProperty('apiTokensCount');
        $this->loginMethods = (array)$this->getDataProperty('loginMethods');
        $this->mfaMethods = (array)$this->getDataProperty('mfaMethods');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
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

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    public function setAvatarUrl(string $avatarUrl): void
    {
        $this->avatarUrl = $avatarUrl;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getLastSeen(): string
    {
        return $this->lastSeen;
    }

    public function setLastSeen(string $lastSeen): void
    {
        $this->lastSeen = $lastSeen;
    }

    public function getTwoFactor(): string
    {
        return $this->twoFactor;
    }

    public function setTwoFactor(string $twoFactor): void
    {
        $this->twoFactor = $twoFactor;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

    public function isEmailVerified(): bool
    {
        return $this->emailVerified;
    }

    public function getJoinDetails(): array
    {
        return $this->joinDetails;
    }

    public function getDeviceVerification(): string
    {
        return $this->deviceVerification;
    }

    public function getTrustedDevicesCount(): int
    {
        return $this->trustedDevicesCount;
    }

    public function getApiTokensCount(): int
    {
        return $this->apiTokensCount;
    }

    /**
     * @return string[]
     */
    public function getLoginMethods(): array
    {
        return $this->loginMethods;
    }

    /**
     * @return string[]
     */
    public function getMfaMethods(): array
    {
        return $this->mfaMethods;
    }
}
