<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class GlossaryConcordance extends BaseModel
{
    /**
     * @var array
     */
    protected $glossary;

    /**
     * @var array
     */
    protected $concept;

    /**
     * @var Term[]
     */
    protected $sourceTerms;

    /**
     * @var Term[]
     */
    protected $targetTerms;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->glossary = (array)$this->getDataProperty('glossary');
        $this->concept = (array)$this->getDataProperty('concept');
        $this->sourceTerms = array_map(
            static function (array $term): Term {
                return new Term($term);
            },
            (array)$this->getDataProperty('sourceTerms')
        );
        $this->targetTerms = array_map(
            static function (array $term): Term {
                return new Term($term);
            },
            $this->getDataProperty('targetTerms')
        );
    }

    public function getGlossary(): array
    {
        return $this->glossary;
    }

    public function getConcept(): array
    {
        return $this->concept;
    }

    /**
     * @return Term[]
     */
    public function getSourceTerms(): array
    {
        return $this->sourceTerms;
    }

    /**
     * @return Term[]
     */
    public function getTargetTerms(): array
    {
        return $this->targetTerms;
    }
}
