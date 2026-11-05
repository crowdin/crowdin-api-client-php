<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class WebhookDelivery extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var int */
    protected $webhookId;

    /** @var string */
    protected $event;

    /** @var string */
    protected $url;

    /** @var string */
    protected $status;

    /** @var int|null */
    protected $responseStatusCode;

    /** @var string|null */
    protected $responseBody;

    /** @var int|null */
    protected $fileId;

    /** @var string|null */
    protected $languageId;

    /** @var string */
    protected $createdAt;

    /** @var string|null */
    protected $requestType;

    /** @var string|null */
    protected $contentType;

    /** @var array|null */
    protected $headers;

    /** @var array|null */
    protected $payload;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->webhookId = (int)$this->getDataProperty('webhookId');
        $this->event = (string)$this->getDataProperty('event');
        $this->url = (string)$this->getDataProperty('url');
        $this->status = (string)$this->getDataProperty('status');
        $this->responseStatusCode = $this->nullableInt('responseStatusCode');
        $this->responseBody = $this->nullableString('responseBody');
        $this->fileId = $this->nullableInt('fileId');
        $this->languageId = $this->nullableString('languageId');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->requestType = $this->nullableString('requestType');
        $this->contentType = $this->nullableString('contentType');
        $this->headers = $this->nullableArray('headers');
        $this->payload = $this->nullableArray('payload');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getWebhookId(): int
    {
        return $this->webhookId;
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string success or failed
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int|null Null when no answer was received
     */
    public function getResponseStatusCode(): ?int
    {
        return $this->responseStatusCode;
    }

    public function getResponseBody(): ?string
    {
        return $this->responseBody;
    }

    public function getFileId(): ?int
    {
        return $this->fileId;
    }

    public function getLanguageId(): ?string
    {
        return $this->languageId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string|null GET or POST. Returned by getDelivery() only
     */
    public function getRequestType(): ?string
    {
        return $this->requestType;
    }

    /**
     * @return string|null Returned by getDelivery() only
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    /**
     * @return array|null Credential header values are masked. Returned by getDelivery() only
     */
    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    /**
     * @return array|null Returned by getDelivery() only
     */
    public function getPayload(): ?array
    {
        return $this->payload;
    }
}
