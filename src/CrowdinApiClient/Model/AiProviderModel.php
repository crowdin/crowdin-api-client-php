<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class AiProviderModel extends BaseModel
{
    /** @var string */
    protected $id;

    /** @var string|null */
    protected $provider;

    /** @var string|null */
    protected $providerName;

    /** @var int|null */
    protected $providerId;

    /** @var int|null */
    protected $contextWindow;

    /** @var int|null */
    protected $maxOutputTokens;

    /** @var bool|null */
    protected $supportsStreaming;

    /** @var bool|null */
    protected $supportsFunctionCalling;

    /** @var bool|null */
    protected $supportsJsonMode;

    /** @var bool|null */
    protected $supportsJsonSchema;

    /** @var bool|null */
    protected $supportsVision;

    /** @var bool */
    protected $isCompatibleWithAiLimit;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (string)$this->getDataProperty('id');
        $this->provider = $this->getDataProperty('provider');
        $this->providerName = $this->getDataProperty('providerName');
        $this->providerId = $this->getDataProperty('providerId');
        $this->contextWindow = $this->nullableInt('contextWindow');
        $this->maxOutputTokens = $this->nullableInt('maxOutputTokens');
        $this->supportsStreaming = $this->nullableBool('supportsStreaming');
        $this->supportsFunctionCalling = $this->nullableBool('supportsFunctionCalling');
        $this->supportsJsonMode = $this->nullableBool('supportsJsonMode');
        $this->supportsJsonSchema = $this->nullableBool('supportsJsonSchema');
        $this->supportsVision = $this->nullableBool('supportsVision');
        $this->isCompatibleWithAiLimit = (bool)$this->getDataProperty('isCompatibleWithAiLimit');
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProvider(): ?string
    {
        return $this->provider;
    }

    public function getProviderName(): ?string
    {
        return $this->providerName;
    }

    public function getProviderId(): ?int
    {
        return $this->providerId;
    }

    public function getContextWindow(): ?int
    {
        return $this->contextWindow;
    }

    public function getMaxOutputTokens(): ?int
    {
        return $this->maxOutputTokens;
    }

    public function getSupportsStreaming(): ?bool
    {
        return $this->supportsStreaming;
    }

    public function getSupportsFunctionCalling(): ?bool
    {
        return $this->supportsFunctionCalling;
    }

    public function getSupportsJsonMode(): ?bool
    {
        return $this->supportsJsonMode;
    }

    public function getSupportsJsonSchema(): ?bool
    {
        return $this->supportsJsonSchema;
    }

    public function getSupportsVision(): ?bool
    {
        return $this->supportsVision;
    }

    public function getIsCompatibleWithAiLimit(): bool
    {
        return $this->isCompatibleWithAiLimit;
    }
}
