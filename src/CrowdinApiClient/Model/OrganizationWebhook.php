<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class OrganizationWebhook extends BaseModel
{
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $url;
    /**
     * @var array
     */
    protected $events;
    /**
     * @var array
     */
    protected $headers;
    /**
     * @var array
     */
    protected $payload;
    /**
     * @var bool
     */
    protected $isActive;
    /**
     * @var bool
     */
    protected $batchingEnabled;
    /**
     * @var string
     */
    protected $requestType;
    /**
     * @var string
     */
    protected $contentType;
    /**
     * @var string
     */
    protected $createdAt;
    /**
     * @var string
     */
    protected $updatedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->id = (string)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->url = (string)$this->getDataProperty('url');
        $this->events = (array)$this->getDataProperty('events');
        $this->headers = (array)$this->getDataProperty('headers');
        $this->payload = (array)$this->getDataProperty('payload');
        $this->isActive = (bool)$this->getDataProperty('isActive');
        $this->batchingEnabled = (bool)$this->getDataProperty('batchingEnabled');
        $this->requestType = (string)$this->getDataProperty('requestType');
        $this->contentType = (string)$this->getDataProperty('contentType');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');

    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return array
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    /**
     * @param array $events
     */
    public function setEvents(array $events): void
    {
        $this->events = $events;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * @param array $payload
     */
    public function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return bool
     */
    public function isBatchingEnabled(): bool
    {
        return $this->batchingEnabled;
    }

    /**
     * @param bool $batchingEnabled
     */
    public function setBatchingEnabled(bool $batchingEnabled): void
    {
        $this->batchingEnabled = $batchingEnabled;
    }

    /**
     * @return string
     */
    public function getRequestType(): string
    {
        return $this->requestType;
    }

    /**
     * @param string $requestType
     */
    public function setRequestType(string $requestType): void
    {
        $this->requestType = $requestType;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType(string $contentType): void
    {
        $this->contentType = $contentType;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
