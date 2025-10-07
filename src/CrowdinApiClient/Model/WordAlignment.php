<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class WordAlignment extends BaseModel
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var Alignment[]
     */
    protected $alignments;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->text = (string)$this->getDataProperty('text');
        $this->alignments = array_map(
            static function (array $alignment): Alignment {
                return new Alignment($alignment);
            },
            (array)$this->getDataProperty('alignments')
        );
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return Alignment[]
     */
    public function getAlignments(): array
    {
        return $this->alignments;
    }
}
