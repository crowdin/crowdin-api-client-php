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

    /**
     * @var bool
     */
    protected $calculateInternalMatches;

    /**
     * @var bool
     */
    protected $includePreTranslatedStrings;

    /**
     * @var bool
     */
    protected $excludeApprovalsForEditedTranslations;

    /**
     * @var bool
     */
    protected $preTranslatedStringsCategorizationAdjustment;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->baseRates = new BaseRates($this->getDataProperty('baseRates') ?? []);
        $this->individualRates = array_map(static function (array $individualRates): IndividualRates {
            return new IndividualRates($individualRates);
        }, $this->getDataProperty('individualRates') ?? []);
        $this->netRateSchemes = new NetRateSchemes($this->getDataProperty('netRateSchemes') ?? []);
        $this->calculateInternalMatches = (bool)$this->getDataProperty('calculateInternalMatches');
        $this->includePreTranslatedStrings = (bool)$this->getDataProperty('includePreTranslatedStrings');
        $this->excludeApprovalsForEditedTranslations = (bool)$this->getDataProperty(
            'excludeApprovalsForEditedTranslations'
        );
        $this->preTranslatedStringsCategorizationAdjustment = (bool)$this->getDataProperty(
            'preTranslatedStringsCategorizationAdjustment'
        );
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

    public function getCalculateInternalMatches(): bool
    {
        return $this->calculateInternalMatches;
    }

    public function setCalculateInternalMatches(bool $calculateInternalMatches): void
    {
        $this->calculateInternalMatches = $calculateInternalMatches;
    }

    public function getIncludePreTranslatedStrings(): bool
    {
        return $this->includePreTranslatedStrings;
    }

    public function setIncludePreTranslatedStrings(bool $includePreTranslatedStrings): void
    {
        $this->includePreTranslatedStrings = $includePreTranslatedStrings;
    }

    public function getExcludeApprovalsForEditedTranslations(): bool
    {
        return $this->excludeApprovalsForEditedTranslations;
    }

    public function setExcludeApprovalsForEditedTranslations(bool $excludeApprovalsForEditedTranslations): void
    {
        $this->excludeApprovalsForEditedTranslations = $excludeApprovalsForEditedTranslations;
    }

    public function getPreTranslatedStringsCategorizationAdjustment(): bool
    {
        return $this->preTranslatedStringsCategorizationAdjustment;
    }

    public function setPreTranslatedStringsCategorizationAdjustment(
        bool $preTranslatedStringsCategorizationAdjustment
    ): void {
        $this->preTranslatedStringsCategorizationAdjustment = $preTranslatedStringsCategorizationAdjustment;
    }

    public function toArray(): array
    {
        return [
            'baseRates' => $this->baseRates->toArray(),
            'individualRates' => array_map(static function (IndividualRates $individualRate): array {
                return $individualRate->toArray();
            }, $this->individualRates),
            'netRateSchemes' => $this->netRateSchemes->toArray(),
            'calculateInternalMatches' => $this->calculateInternalMatches,
            'includePreTranslatedStrings' => $this->includePreTranslatedStrings,
            'excludeApprovalsForEditedTranslations' => $this->excludeApprovalsForEditedTranslations,
            'preTranslatedStringsCategorizationAdjustment' => $this->preTranslatedStringsCategorizationAdjustment,
        ];
    }
}
