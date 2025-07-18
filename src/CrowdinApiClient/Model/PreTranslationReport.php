<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class PreTranslationReport extends BaseModel
{
    /**
     * @var string
     */
    protected $preTranslationType;

    /**
     * @var PreTranslationReportLanguage[]
     */
    protected $languages;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->preTranslationType = (string)$this->getDataProperty('preTranslateType');
        $this->languages = array_map(static function (array $language): PreTranslationReportLanguage {
            return new PreTranslationReportLanguage($language);
        }, (array)$this->getDataProperty('languages'));
    }

    public function getPreTranslationType(): string
    {
        return $this->preTranslationType;
    }

    /**
     * @return PreTranslationReportLanguage[]
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }
}
