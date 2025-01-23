<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

use InvalidArgumentException;

/**
 * @package Crowdin\Model
 */
class ReportSettingsTemplateConfig extends BaseModel
{
    /**
     * @var BaseRates
     */
    protected $baseRates;

    /**
     * @var IndividualRates[]
     */
    protected $individualRates;

    /**
     * @var NetRateSchemes
     */
    protected $netRateSchemes;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->baseRates = new BaseRates($this->getDataProperty('baseRates') ?? []);
        $this->individualRates = array_map(static function (array $individualRates): IndividualRates {
            return new IndividualRates($individualRates);
        }, $this->getDataProperty('individualRates') ?? []);
        $this->netRateSchemes = new NetRateSchemes($this->getDataProperty('netRateSchemes') ?? []);
    }

    public function getBaseRates(): BaseRates
    {
        return $this->baseRates;
    }

    public function setBaseRates(BaseRates $baseRates): void
    {
        $this->baseRates = $baseRates;
    }

    /**
     * @return IndividualRates[]
     */
    public function getIndividualRates(): array
    {
        return $this->individualRates;
    }

    /**
     * @param IndividualRates[] $individualRates
     */
    public function setIndividualRates(array $individualRates): void
    {
        if ($individualRates === []) {
            throw new InvalidArgumentException('Argument "individualRates" cannot be empty');
        }

        foreach ($individualRates as $individualRate) {
            if (!$individualRate instanceof IndividualRates) {
                throw new InvalidArgumentException(
                    'Argument "individualRates" must contain only IndividualRates objects'
                );
            }
        }

        $this->individualRates = $individualRates;
    }

    public function getNetRateSchemes(): NetRateSchemes
    {
        return $this->netRateSchemes;
    }

    public function setNetRateSchemes(NetRateSchemes $netRateSchemes): void
    {
        $this->netRateSchemes = $netRateSchemes;
    }

    public function toArray(): array
    {
        return [
            'baseRates' => $this->baseRates->toArray(),
            'individualRates' => array_map(static function (IndividualRates $individualRate): array {
                return $individualRate->toArray();
            }, $this->individualRates),
            'netRateSchemes' => $this->netRateSchemes->toArray(),
        ];
    }
}
