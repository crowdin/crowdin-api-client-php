<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

use InvalidArgumentException;

abstract class AbstractUserReportSettingsTemplate extends BaseModel
{
    public const SUPPORTED_UNITS = [
        Report::UNIT_STRINGS,
        Report::UNIT_WORDS,
        Report::UNIT_CHARS,
        Report::UNIT_CHARS_WITH_SPACES,
        Report::UNIT_HOURS,
    ];

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $unit;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string|null
     */
    protected $updatedAt;

    public function getId(): int
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

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        if (!in_array($currency, Report::CURRENCIES, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Argument "currency" must be one of the following values: %s',
                    implode(', ', Report::CURRENCIES)
                )
            );
        }

        $this->currency = $currency;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): void
    {
        if (!in_array($unit, static::SUPPORTED_UNITS, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Argument "unit" must be one of the following values: %s',
                    implode(', ', static::SUPPORTED_UNITS)
                )
            );
        }

        $this->unit = $unit;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'currency' => $this->currency,
            'unit' => $this->unit,
            'config' => $this->config->toArray(),
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }

    abstract public function getConfig();

    abstract public function setConfig($config): void;
}
