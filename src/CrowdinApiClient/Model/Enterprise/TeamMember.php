<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

/**
 * @package Crowdin\Model\Enterprise
 */
class TeamMember extends BaseModel
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
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $avatarUrl;

    /**
     * @var string
     */
    protected $addedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->username = (string)$this->getDataProperty('username');
        $this->firstName = (string)$this->getDataProperty('firstName');
        $this->lastName = (string)$this->getDataProperty('lastName');
        $this->avatarUrl = (string)$this->getDataProperty('avatarUrl');
        $this->addedAt = (string)$this->getDataProperty('addedAt');
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

    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    public function setAvatarUrl(string $avatarUrl): void
    {
        $this->avatarUrl = $avatarUrl;
    }

    public function getAddedAt(): string
    {
        return $this->addedAt;
    }

    public function setAddedAt(string $addedAt): void
    {
        $this->addedAt = $addedAt;
    }
}
