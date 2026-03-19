<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

use InvalidArgumentException;

/**
 * @package Crowdin\Model
 */
class UserReportSettingsTemplate extends BaseModel
{
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
     * @var ReportSettingsTemplateConfig
     */
    protected $config;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string|null
     */
    protected $updatedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->currency = (string)$this->getDataProperty('currency');
        $this->unit = (string)$this->getDataProperty('unit');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = $this->getDataProperty('updatedAt') ? (string)$this->getDataProperty('updatedAt') : null;

        if ($this->unit === Report::UNIT_HOURS) {
            $this->config = new HourlyReportSettingsTemplateConfig($this->getDataProperty('config') ?? []);
        } else {
            $this->config = new ReportSettingsTemplateConfig($this->getDataProperty('config') ?? []);
        }
    }

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
        if (!in_array($unit, Report::UNITS, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Argument "unit" must be one of the following values: %s',
                    implode(', ', Report::UNITS)
                )
            );
        }

        $this->unit = $unit;
    }

    /**
     * @return HourlyReportSettingsTemplateConfig|ReportSettingsTemplateConfig
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param HourlyReportSettingsTemplateConfig|ReportSettingsTemplateConfig $config
     */
    public function setConfig($config): void
    {
        $this->config = $config;
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
}
