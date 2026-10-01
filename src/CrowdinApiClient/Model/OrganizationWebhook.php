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

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function setEvents(array $events): void
    {
        $this->events = $events;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function isBatchingEnabled(): bool
    {
        return $this->batchingEnabled;
    }

    public function setBatchingEnabled(bool $batchingEnabled): void
    {
        $this->batchingEnabled = $batchingEnabled;
    }

    public function getRequestType(): string
    {
        return $this->requestType;
    }

    public function setRequestType(string $requestType): void
    {
        $this->requestType = $requestType;
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function setContentType(string $contentType): void
    {
        $this->contentType = $contentType;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
