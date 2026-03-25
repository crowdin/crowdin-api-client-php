<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class HourlyUserReportSettingsTemplate extends AbstractUserReportSettingsTemplate
{
    public const SUPPORTED_UNITS = [
        Report::UNIT_HOURS,
    ];

    protected $unit = Report::UNIT_HOURS;

    /**
     * @var HourlyReportSettingsTemplateConfig
     */
    protected $config;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->currency = (string)$this->getDataProperty('currency');
        $this->config = new HourlyReportSettingsTemplateConfig($this->getDataProperty('config') ?? []);
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = $this->getDataProperty('updatedAt') ? (string)$this->getDataProperty('updatedAt') : null;
    }

    public function getConfig(): HourlyReportSettingsTemplateConfig
    {
        return $this->config;
    }

    /**
     * @param HourlyReportSettingsTemplateConfig $config
     */
    public function setConfig($config): void
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
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
