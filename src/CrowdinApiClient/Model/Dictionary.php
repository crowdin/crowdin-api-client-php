<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class Dictionary extends BaseModel
{
    /** @var string */
    protected $languageId;

    /** @var string[] */
    protected $words;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->words = (array)$this->getDataProperty('words');
    }

    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    /**
     * @return string[]
     */
    public function getWords(): array
    {
        return $this->words;
    }
}
