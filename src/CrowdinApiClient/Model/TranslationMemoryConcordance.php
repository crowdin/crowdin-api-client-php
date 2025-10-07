<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class TranslationMemoryConcordance extends BaseModel
{
    /**
     * @var TranslationMemory
     */
    protected $tm;

    /**
     * @var int
     */
    protected $recordId;

    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $target;

    /**
     * @var int
     */
    protected $relevant;

    /**
     * @var string|null
     */
    protected $substituted;

    /**
     * @var string|null
     */
    protected $updatedAt;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->tm = new TranslationMemory($this->getDataProperty('tm'));
        $this->recordId = (int)$this->getDataProperty('recordId');
        $this->source = (string)$this->getDataProperty('source');
        $this->target = (string)$this->getDataProperty('target');
        $this->relevant = (int)$this->getDataProperty('relevant');
        $this->substituted = $this->getDataProperty('substituted');
        $this->updatedAt = $this->getDataProperty('updatedAt');
    }

    public function getTm(): TranslationMemory
    {
        return $this->tm;
    }

    public function getRecordId(): int
    {
        return $this->recordId;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getTarget(): string
    {
        return $this->target;
    }

    public function getRelevant(): int
    {
        return $this->relevant;
    }

    /**
     * @return string|null
     */
    public function getSubstituted(): ?string
    {
        return $this->substituted;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
}
