<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class AiSupportedModel extends BaseModel
{
    /** @var int|null */
    protected $providerId;

    /** @var string */
    protected $providerType;

    /** @var string */
    protected $providerName;

    /** @var string */
    protected $id;

    /** @var string */
    protected $displayName;

    /** @var bool */
    protected $supportReasoning;

    /** @var int */
    protected $intelligence;

    /** @var int */
    protected $speed;

    /** @var array */
    protected $price;

    /** @var array */
    protected $modalities;

    /** @var int */
    protected $contextWindow;

    /** @var int */
    protected $maxOutputTokens;

    /** @var string|null */
    protected $knowledgeCutoff;

    /** @var string|null */
    protected $releaseDate;

    /** @var array */
    protected $features;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->providerId = $this->nullableInt('providerId');
        $this->providerType = (string)$this->getDataProperty('providerType');
        $this->providerName = (string)$this->getDataProperty('providerName');
        $this->id = (string)$this->getDataProperty('id');
        $this->displayName = (string)$this->getDataProperty('displayName');
        $this->supportReasoning = (bool)$this->getDataProperty('supportReasoning');
        $this->intelligence = (int)$this->getDataProperty('intelligence');
        $this->speed = (int)$this->getDataProperty('speed');
        $this->price = (array)$this->getDataProperty('price');
        $this->modalities = (array)$this->getDataProperty('modalities');
        $this->contextWindow = (int)$this->getDataProperty('contextWindow');
        $this->maxOutputTokens = (int)$this->getDataProperty('maxOutputTokens');
        $this->knowledgeCutoff = $this->nullableString('knowledgeCutoff');
        $this->releaseDate = $this->nullableString('releaseDate');
        $this->features = (array)$this->getDataProperty('features');
    }

    public function getProviderId(): ?int
    {
        return $this->providerId;
    }

    public function getProviderType(): string
    {
        return $this->providerType;
    }

    public function getProviderName(): string
    {
        return $this->providerName;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function getSupportReasoning(): bool
    {
        return $this->supportReasoning;
    }

    public function getIntelligence(): int
    {
        return $this->intelligence;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @return array input, output
     */
    public function getPrice(): array
    {
        return $this->price;
    }

    /**
     * @return array input, output
     */
    public function getModalities(): array
    {
        return $this->modalities;
    }

    public function getContextWindow(): int
    {
        return $this->contextWindow;
    }

    public function getMaxOutputTokens(): int
    {
        return $this->maxOutputTokens;
    }

    public function getKnowledgeCutoff(): ?string
    {
        return $this->knowledgeCutoff;
    }

    public function getReleaseDate(): ?string
    {
        return $this->releaseDate;
    }

    /**
     * @return array streaming, structuredOutput, functionCalling
     */
    public function getFeatures(): array
    {
        return $this->features;
    }
}
