<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class PreTranslationReportFile extends BaseModel
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var PreTranslationReportFileStatistics
     */
    protected $statistics;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (string)$this->getDataProperty('id');
        $this->statistics = new PreTranslationReportFileStatistics((array)$this->getDataProperty('statistics'));
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getStatistics(): PreTranslationReportFileStatistics
    {
        return $this->statistics;
    }
}
