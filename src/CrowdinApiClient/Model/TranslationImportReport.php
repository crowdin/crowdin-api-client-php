<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class TranslationImportReport extends BaseModel
{
    /**
     * @var PreTranslationReportLanguage[]
     */
    protected $languages;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->languages = array_map(static function (array $language): PreTranslationReportLanguage {
            return new PreTranslationReportLanguage($language);
        }, (array)$this->getDataProperty('languages'));
    }

    /**
     * @return PreTranslationReportLanguage[]
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }
}
