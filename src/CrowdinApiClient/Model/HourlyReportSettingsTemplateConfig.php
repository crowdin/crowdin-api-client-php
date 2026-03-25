<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

use InvalidArgumentException;

/**
 * @package Crowdin\Model
 */
class HourlyReportSettingsTemplateConfig extends BaseModel
{
    /**
     * @var HourlyBaseRates
     */
    protected $baseRates;

    /**
     * @var HourlyIndividualRates[]
     */
    protected $individualRates;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->baseRates = new HourlyBaseRates($this->getDataProperty('baseRates') ?? []);
        $this->individualRates = array_map(static function (array $individualRates): HourlyIndividualRates {
            return new HourlyIndividualRates($individualRates);
        }, $this->getDataProperty('individualRates') ?? []);
    }

    public function getBaseRates(): HourlyBaseRates
    {
        return $this->baseRates;
    }

    public function setBaseRates(HourlyBaseRates $baseRates): void
    {
        $this->baseRates = $baseRates;
    }

    /**
     * @return HourlyIndividualRates[]
     */
    public function getIndividualRates(): array
    {
        return $this->individualRates;
    }

    /**
     * @param HourlyIndividualRates[] $individualRates
     */
    public function setIndividualRates(array $individualRates): void
    {
        if ($individualRates === []) {
            throw new InvalidArgumentException('Argument "individualRates" cannot be empty');
        }

        foreach ($individualRates as $individualRate) {
            if (!$individualRate instanceof HourlyIndividualRates) {
                throw new InvalidArgumentException(
                    'Argument "individualRates" must contain only HourlyIndividualRates objects'
                );
            }
        }

        $this->individualRates = $individualRates;
    }

    public function toArray(): array
    {
        return [
            'baseRates' => $this->baseRates->toArray(),
            'individualRates' => array_map(static function (HourlyIndividualRates $individualRate): array {
                return $individualRate->toArray();
            }, $this->individualRates),
        ];
    }
}
