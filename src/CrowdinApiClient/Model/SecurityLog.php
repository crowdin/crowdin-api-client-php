<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class SecurityLog extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $event;

    /**
     * @var string
     */
    protected $info;

    /**
     * @var integer
     */
    protected $userId;

    /**
     * @var string
     */
    protected $location;

    /**
     * @var string
     */
    protected $ipAddress;

    /**
     * @var string
     */
    protected $deviceName;

    /**
     * @var string
     */
    protected $createdAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->event = (string)$this->getDataProperty('event');
        $this->info = (string)$this->getDataProperty('info');
        $this->userId = (int)$this->getDataProperty('userId');
        $this->location = (string)$this->getDataProperty('location');
        $this->ipAddress = (string)$this->getDataProperty('ipAddress');
        $this->deviceName = (string)$this->getDataProperty('deviceName');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function getDeviceName(): string
    {
        return $this->deviceName;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
