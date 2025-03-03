<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class BaseRates extends BaseModel
{
    /**
     * @var float
     */
    protected $fullTranslation;

    /**
     * @var float
     */
    protected $proofread;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->fullTranslation = (float)$this->getDataProperty('fullTranslation');
        $this->proofread = (float)$this->getDataProperty('proofread');
    }

    public function getFullTranslation(): float
    {
        return $this->fullTranslation;
    }

    public function setFullTranslation(float $fullTranslation): void
    {
        $this->fullTranslation = $fullTranslation;
    }

    public function getProofread(): float
    {
        return $this->proofread;
    }

    public function setProofread(float $proofread): void
    {
        $this->proofread = $proofread;
    }

    public function toArray(): array
    {
        return [
            'fullTranslation' => $this->fullTranslation,
            'proofread' => $this->proofread,
        ];
    }
}
