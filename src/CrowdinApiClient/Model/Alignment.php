<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Alignment extends BaseModel
{
    /**
     * @var string
     */
    protected $sourceWord;

    /**
     * @var string
     */
    protected $sourceLemma;

    /**
     * @var string
     */
    protected $targetWord;

    /**
     * @var string
     */
    protected $targetLemma;

    /**
     * @var int
     */
    protected $match;

    /**
     * @var float
     */
    protected $probability;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->sourceWord = (string)$this->getDataProperty('sourceWord');
        $this->sourceLemma = (string)$this->getDataProperty('sourceLemma');
        $this->targetWord = (string)$this->getDataProperty('targetWord');
        $this->targetLemma = (string)$this->getDataProperty('targetLemma');
        $this->match = (int)$this->getDataProperty('match');
        $this->probability = (float)$this->getDataProperty('probability');
    }

    /**
     * @return string
     */
    public function getSourceWord(): string
    {
        return $this->sourceWord;
    }

    /**
     * @return string
     */
    public function getSourceLemma(): string
    {
        return $this->sourceLemma;
    }

    /**
     * @return string
     */
    public function getTargetWord(): string
    {
        return $this->targetWord;
    }

    /**
     * @return string
     */
    public function getTargetLemma(): string
    {
        return $this->targetLemma;
    }

    /**
     * @return int
     */
    public function getMatch(): int
    {
        return $this->match;
    }

    /**
     * @return float
     */
    public function getProbability(): float
    {
        return $this->probability;
    }
}
