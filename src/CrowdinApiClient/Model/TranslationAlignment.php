<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class TranslationAlignment extends BaseModel
{
    /**
     * @var WordAlignment[]
     */
    protected $words;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->words = array_map(
            static function (array $word): WordAlignment {
                return new WordAlignment($word);
            },
            (array)$this->getDataProperty('words')
        );
    }

    /**
     * @return WordAlignment[]
     */
    public function getWords(): array
    {
        return $this->words;
    }
}
