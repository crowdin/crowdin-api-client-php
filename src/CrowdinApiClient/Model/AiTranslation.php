<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class AiTranslation extends BaseModel
{
    /**
     * @var string
     */
    protected $sourceLanguageId;

    /**
     * @var string
     */
    protected $targetLanguageId;

    /**
     * @var array
     */
    protected $translations;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->sourceLanguageId = (string)$this->getDataProperty('sourceLanguageId');
        $this->targetLanguageId = (string)$this->getDataProperty('targetLanguageId');
        $this->translations = (array)$this->getDataProperty('translations');
    }

    public function getSourceLanguageId(): string
    {
        return $this->sourceLanguageId;
    }

    public function getTargetLanguageId(): string
    {
        return $this->targetLanguageId;
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }
}
