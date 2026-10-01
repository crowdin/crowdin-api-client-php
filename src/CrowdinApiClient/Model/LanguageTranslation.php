<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class LanguageTranslation extends BaseModel
{
    /**
     * @var int
     */
    protected $stringId;

    /**
     * @var string
     */
    protected $contentType;

    /**
     * @var int
     */
    protected $translationId;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var array|null
     */
    protected $user;

    /**
     * @var array
     */
    protected $plurals;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var bool
     */
    protected $isPreTranslated;

    /**
     * @var int|null
     */
    protected $matchRate;

    /**
     * @var string|null
     */
    protected $matchType;

    /**
     * @var string|null
     */
    protected $provider;

    /**
     * @var int|null
     */
    protected $providerId;

    /**
     * @var string
     */
    protected $qaIssuesStatus;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->stringId = (int)$this->getDataProperty('stringId');
        $this->contentType = (string)$this->getDataProperty('contentType');
        $this->translationId = $this->nullableInt('translationId');
        $this->text = $this->nullableString('text');
        $this->plurals = $this->nullableArray('plurals');
        $this->user = $this->nullableArray('user');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->isPreTranslated = (bool)$this->getDataProperty('isPreTranslated');
        $this->matchRate = $this->nullableInt('matchRate');
        $this->matchType = $this->nullableString('matchType');
        $this->provider = $this->nullableString('provider');
        $this->providerId = $this->nullableInt('providerId');
        $this->qaIssuesStatus = (string)$this->getDataProperty('qaIssuesStatus');
    }

    public function getStringId(): int
    {
        return $this->stringId;
    }

    public function setStringId(int $stringId): void
    {
        $this->stringId = $stringId;
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function getTranslationId(): ?int
    {
        return $this->translationId;
    }

    public function setTranslationId(int $translationId): void
    {
        $this->translationId = $translationId;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getUser(): ?array
    {
        return $this->user;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getPlurals(): ?array
    {
        return $this->plurals;
    }

    public function setPlurals(array $plurals): void
    {
        $this->plurals = $plurals;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function isPreTranslated(): bool
    {
        return $this->isPreTranslated;
    }

    public function getMatchRate(): ?int
    {
        return $this->matchRate;
    }

    public function getMatchType(): ?string
    {
        return $this->matchType;
    }

    public function getProvider(): ?string
    {
        return $this->provider;
    }

    public function getProviderId(): ?int
    {
        return $this->providerId;
    }

    public function getQaIssuesStatus(): string
    {
        return $this->qaIssuesStatus;
    }
}
