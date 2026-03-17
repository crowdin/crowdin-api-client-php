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

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

    /**
     * @return bool
     */
    public function isEmailVerified(): bool
    {
        return $this->emailVerified;
    }

    /**
     * @return array
     */
    public function getJoinDetails(): array
    {
        return $this->joinDetails;
    }

    /**
     * @return string
     */
    public function getDeviceVerification(): string
    {
        return $this->deviceVerification;
    }

    /**
     * @return int
     */
    public function getTrustedDevicesCount(): int
    {
        return $this->trustedDevicesCount;
    }

    /**
     * @return int
     */
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
