<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class WebhookTestResult extends BaseModel
{
    /** @var string */
    protected $event;

    /** @var string */
    protected $url;

    /** @var array */
    protected $payload;

    /** @var string */
    protected $status;

    /** @var int|null */
    protected $responseStatusCode;

    /** @var string|null */
    protected $responseBody;

    /** @var string|null */
    protected $error;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->event = (string)$this->getDataProperty('event');
        $this->url = (string)$this->getDataProperty('url');
        $this->payload = (array)$this->getDataProperty('payload');
        $this->status = (string)$this->getDataProperty('status');
        $this->responseStatusCode = $this->nullableInt('responseStatusCode');
        $this->responseBody = $this->nullableString('responseBody');
        $this->error = $this->nullableString('error');
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPayload(): array
    {
        return $this->payload;
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

    /**
     * @return string|null couldNotConnect, timeout or forbiddenHost. Null when an answer was received
     */
    public function getError(): ?string
    {
        return $this->error;
    }
}
