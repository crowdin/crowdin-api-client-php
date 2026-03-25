<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class UserReportSettingsTemplate extends AbstractUserReportSettingsTemplate
{
    public const SUPPORTED_UNITS = [
        Report::UNIT_STRINGS,
        Report::UNIT_WORDS,
        Report::UNIT_CHARS,
        Report::UNIT_CHARS_WITH_SPACES,
    ];

    /**
     * @var ReportSettingsTemplateConfig
     */
    protected $config;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->currency = (string)$this->getDataProperty('currency');
        $this->unit = (string)$this->getDataProperty('unit');
        $this->config = new ReportSettingsTemplateConfig($this->getDataProperty('config') ?? []);
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = $this->getDataProperty('updatedAt') ? (string)$this->getDataProperty('updatedAt') : null;
    }

    public function getConfig(): ReportSettingsTemplateConfig
    {
        return $this->config;
    }

    /**
     * @param ReportSettingsTemplateConfig $config
     */
    public function setConfig($config): void
    {
        $this->config = $config;
    }
}
