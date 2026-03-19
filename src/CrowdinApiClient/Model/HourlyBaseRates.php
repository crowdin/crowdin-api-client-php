<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class HourlyBaseRates extends BaseModel
{
    /**
     * @var float
     */
    protected $hourly;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->hourly = (float)$this->getDataProperty('hourly');
    }

    public function getHourly(): float
    {
        return $this->hourly;
    }

    public function setHourly(float $hourly): void
    {
        $this->hourly = $hourly;
    }

    public function toArray(): array
    {
        return [
            'hourly' => $this->hourly,
        ];
    }
}
