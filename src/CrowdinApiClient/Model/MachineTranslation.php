<?php

namespace CrowdinApiClient\Model;

class MachineTranslation extends BaseModel
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
     * @var string[]
     */
    protected $strings;

    /**
     * @var string[]
     */
    protected $translations;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->sourceLanguageId = (string)$this->getDataProperty('sourceLanguageId');
        $this->targetLanguageId = (string)$this->getDataProperty('targetLanguageId');
        $this->strings = (array)$this->getDataProperty('strings');
        $this->translations = (array)$this->getDataProperty('translations');
    }

    /**
     * @return string
     */
    public function getSourceLanguageId(): string
    {
        return $this->sourceLanguageId;
    }

    /**
     * @param string $sourceLanguageId
     */
    public function setSourceLanguageId(string $sourceLanguageId): void
    {
        $this->sourceLanguageId = $sourceLanguageId;
    }

    /**
     * @return string
     */
    public function getTargetLanguageId(): string
    {
        return $this->targetLanguageId;
    }

    /**
     * @param string $targetLanguageId
     */
    public function setTargetLanguageId(string $targetLanguageId): void
    {
        $this->targetLanguageId = $targetLanguageId;
    }

    /**
     * @return array|string[]
     */
    public function getStrings(): array
    {
        return $this->strings;
    }

    /**
     * @param array|string[] $strings
     */
    public function setStrings(array $strings): void
    {
        $this->strings = $strings;
    }

    /**
     * @return array|string[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**
     * @param array|string[] $translations
     */
    public function setTranslations(array $translations): void
    {
        $this->translations = $translations;
    }
}
