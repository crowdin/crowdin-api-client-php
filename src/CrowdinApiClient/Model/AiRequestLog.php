<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class AiRequestLog extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $requestId;

    /** @var string */
    protected $createdAt;

    /** @var string */
    protected $status;

    /** @var int|null */
    protected $httpStatus;

    /** @var string */
    protected $model;

    /** @var string */
    protected $sourceAction;

    /** @var string|null */
    protected $promptAction;

    /** @var bool */
    protected $systemCredentials;

    /** @var bool */
    protected $isAutoTriggered;

    /** @var int|null */
    protected $durationMs;

    /** @var int|null */
    protected $inputTokens;

    /** @var int|null */
    protected $outputTokens;

    /** @var float|null */
    protected $totalCost;

    /** @var int|null */
    protected $userId;

    /** @var int|null */
    protected $projectId;

    /** @var int|null */
    protected $promptId;

    /** @var int */
    protected $aiProviderId;

    /** @var string|null */
    protected $tokenName;

    /** @var string|null */
    protected $oauthClientId;

    /** @var string|null */
    protected $oauthClientName;

    /** @var string|null */
    protected $ip;

    /** @var string|null */
    protected $userAgent;

    /** @var string|null */
    protected $error;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->requestId = (string)$this->getDataProperty('requestId');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->status = (string)$this->getDataProperty('status');
        $this->httpStatus = $this->getDataProperty('httpStatus');
        $this->model = (string)$this->getDataProperty('model');
        $this->sourceAction = (string)$this->getDataProperty('sourceAction');
        $this->promptAction = $this->getDataProperty('promptAction');
        $this->systemCredentials = (bool)$this->getDataProperty('systemCredentials');
        $this->isAutoTriggered = (bool)$this->getDataProperty('isAutoTriggered');
        $this->durationMs = $this->getDataProperty('durationMs');
        $this->inputTokens = $this->getDataProperty('inputTokens');
        $this->outputTokens = $this->getDataProperty('outputTokens');
        $this->totalCost = $this->getDataProperty('totalCost');
        $this->userId = $this->getDataProperty('userId');
        $this->projectId = $this->getDataProperty('projectId');
        $this->promptId = $this->getDataProperty('promptId');
        $this->aiProviderId = (int)$this->getDataProperty('aiProviderId');
        $this->tokenName = $this->getDataProperty('tokenName');
        $this->oauthClientId = $this->getDataProperty('oauthClientId');
        $this->oauthClientName = $this->getDataProperty('oauthClientName');
        $this->ip = $this->getDataProperty('ip');
        $this->userAgent = $this->getDataProperty('userAgent');
        $this->error = $this->getDataProperty('error');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRequestId(): string
    {
        return $this->requestId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getHttpStatus(): ?int
    {
        return $this->httpStatus;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getSourceAction(): string
    {
        return $this->sourceAction;
    }

    public function getPromptAction(): ?string
    {
        return $this->promptAction;
    }

    public function isSystemCredentials(): bool
    {
        return $this->systemCredentials;
    }

    public function isAutoTriggered(): bool
    {
        return $this->isAutoTriggered;
    }

    public function getDurationMs(): ?int
    {
        return $this->durationMs;
    }

    public function getInputTokens(): ?int
    {
        return $this->inputTokens;
    }

    public function getOutputTokens(): ?int
    {
        return $this->outputTokens;
    }

    public function getTotalCost(): ?float
    {
        return $this->totalCost;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    public function getPromptId(): ?int
    {
        return $this->promptId;
    }

    public function getAiProviderId(): int
    {
        return $this->aiProviderId;
    }

    public function getTokenName(): ?string
    {
        return $this->tokenName;
    }

    public function getOauthClientId(): ?string
    {
        return $this->oauthClientId;
    }

    public function getOauthClientName(): ?string
    {
        return $this->oauthClientName;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function getError(): ?string
    {
        return $this->error;
    }
}
