<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Report extends BaseModel
{
    public const CURRENCY_USD = 'USD';
    public const CURRENCY_EUR = 'EUR';
    public const CURRENCY_JPY = 'JPY';
    public const CURRENCY_GBP = 'GBP';
    public const CURRENCY_AUD = 'AUD';
    public const CURRENCY_CAD = 'CAD';
    public const CURRENCY_CHF = 'CHF';
    public const CURRENCY_CNY = 'CNY';
    public const CURRENCY_SEK = 'SEK';
    public const CURRENCY_NZD = 'NZD';
    public const CURRENCY_MXN = 'MXN';
    public const CURRENCY_SGD = 'SGD';
    public const CURRENCY_HKD = 'HKD';
    public const CURRENCY_NOK = 'NOK';
    public const CURRENCY_KRW = 'KRW';
    public const CURRENCY_TRY = 'TRY';
    public const CURRENCY_RUB = 'RUB';
    public const CURRENCY_INR = 'INR';
    public const CURRENCY_BRL = 'BRL';
    public const CURRENCY_ZAR = 'ZAR';
    public const CURRENCY_GEL = 'GEL';
    public const CURRENCY_UAH = 'UAH';
    public const CURRENCY_DDK = 'DDK';

    public const CURRENCIES = [
        self::CURRENCY_USD,
        self::CURRENCY_EUR,
        self::CURRENCY_JPY,
        self::CURRENCY_GBP,
        self::CURRENCY_AUD,
        self::CURRENCY_CAD,
        self::CURRENCY_CHF,
        self::CURRENCY_CNY,
        self::CURRENCY_SEK,
        self::CURRENCY_NZD,
        self::CURRENCY_MXN,
        self::CURRENCY_SGD,
        self::CURRENCY_HKD,
        self::CURRENCY_NOK,
        self::CURRENCY_KRW,
        self::CURRENCY_TRY,
        self::CURRENCY_RUB,
        self::CURRENCY_INR,
        self::CURRENCY_BRL,
        self::CURRENCY_ZAR,
        self::CURRENCY_GEL,
        self::CURRENCY_UAH,
        self::CURRENCY_DDK,
    ];

    public const UNIT_STRINGS = 'strings';
    public const UNIT_WORDS = 'words';
    public const UNIT_CHARS = 'chars';
    public const UNIT_CHARS_WITH_SPACES = 'chars_with_spaces';

    public const UNITS = [
        self::UNIT_STRINGS,
        self::UNIT_WORDS,
        self::UNIT_CHARS,
        self::UNIT_CHARS_WITH_SPACES,
    ];

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var integer
     */
    protected $progress;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * @var string
     */
    protected $startedAt;

    /**
     * @var string
     */
    protected $finishedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->identifier = (string)$this->getDataProperty('identifier');
        $this->status = (string)$this->getDataProperty('status');
        $this->progress = (integer)$this->getDataProperty('progress');
        $this->attributes = (array)$this->getDataProperty('attributes');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
        $this->startedAt = (string)$this->getDataProperty('startedAt');
        $this->finishedAt = (string)$this->getDataProperty('finishedAt');
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getProgress(): int
    {
        return $this->progress;
    }

    /**
     * @param int $progress
     */
    public function setProgress(int $progress): void
    {
        $this->progress = $progress;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function getStartedAt(): string
    {
        return $this->startedAt;
    }

    /**
     * @param string $startedAt
     */
    public function setStartedAt(string $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    /**
     * @return string
     */
    public function getFinishedAt(): string
    {
        return $this->finishedAt;
    }

    /**
     * @param string $finishedAt
     */
    public function setFinishedAt(string $finishedAt): void
    {
        $this->finishedAt = $finishedAt;
    }
}
