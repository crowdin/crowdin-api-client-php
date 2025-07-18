<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class PreTranslationReportLanguage extends BaseModel
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var PreTranslationReportFile[]
     */
    protected $files;

    /**
     * @var array<string, int>
     */
    protected $skippedInfo;

    /**
     * @var array<string, int>
     */
    protected $skippedQaCheckCategories;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (string)$this->getDataProperty('id');
        $this->files = array_map(static function (array $file): PreTranslationReportFile {
            return new PreTranslationReportFile($file);
        }, (array)$this->getDataProperty('files'));
        $this->skippedInfo = (array)$this->getDataProperty('skipped');
        $this->skippedQaCheckCategories = (array)$this->getDataProperty('skippedQaCheckCategories');
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function getSkippedInfo(): array
    {
        return $this->skippedInfo;
    }

    public function getSkippedQaCheckCategories(): array
    {
        return $this->skippedQaCheckCategories;
    }
}
