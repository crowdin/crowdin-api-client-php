<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class NetRate extends BaseModel
{
    /**
     * @var string
     */
    protected $matchType;

    /**
     * @var float
     */
    protected $price;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->matchType = (string)$this->getDataProperty('matchType');
        $this->price = (float)$this->getDataProperty('price');
    }

    public function getMatchType(): string
    {
        return $this->matchType;
    }

    public function setMatchType(string $matchType): void
    {
        $this->matchType = $matchType;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function toArray(): array
    {
        return [
            'matchType' => $this->matchType,
            'price' => $this->price,
        ];
    }
}
