<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

use InvalidArgumentException;

/**
 * @package Crowdin\Model
 */
class NetRateSchemes extends BaseModel
{
    /**
     * @var NetRate[]
     */
    protected $tmMatch;

    /**
     * @var NetRate[]
     */
    protected $mtMatch;

    /**
     * @var NetRate[]
     */
    protected $aiMatch;

    /**
     * @var NetRate[]
     */
    protected $suggestionMatch;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->tmMatch = array_map(static function (array $rate): NetRate {
            return new NetRate($rate);
        }, $this->getDataProperty('tmMatch') ?? []);
        $this->mtMatch = array_map(static function (array $rate): NetRate {
            return new NetRate($rate);
        }, $this->getDataProperty('mtMatch') ?? []);
        $this->aiMatch = array_map(static function (array $rate): NetRate {
            return new NetRate($rate);
        }, $this->getDataProperty('aiMatch') ?? []);
        $this->suggestionMatch = array_map(static function (array $rate): NetRate {
            return new NetRate($rate);
        }, $this->getDataProperty('suggestionMatch') ?? []);
    }

    /**
     * @return NetRate[]
     */
    public function getTmMatch(): array
    {
        return $this->tmMatch;
    }

    /**
     * @param NetRate[] $tmMatch
     */
    public function setTmMatch(array $tmMatch): void
    {
        if ($tmMatch === []) {
            throw new InvalidArgumentException('Argument "tmMatch" cannot be empty');
        }

        foreach ($tmMatch as $netRate) {
            if (!$netRate instanceof NetRate) {
                throw new InvalidArgumentException('Argument "tmMatch" must contain only NetRate objects');
            }
        }

        $this->tmMatch = $tmMatch;
    }

    /**
     * @return NetRate[]
     */
    public function getMtMatch(): array
    {
        return $this->mtMatch;
    }

    /**
     * @param NetRate[] $mtMatch
     */
    public function setMtMatch(array $mtMatch): void
    {
        if ($mtMatch === []) {
            throw new InvalidArgumentException('Argument "mtMatch" cannot be empty');
        }

        foreach ($mtMatch as $netRate) {
            if (!$netRate instanceof NetRate) {
                throw new InvalidArgumentException('Argument "mtMatch" must contain only NetRate objects');
            }
        }

        $this->mtMatch = $mtMatch;
    }

    /**
     * @return NetRate[]
     */
    public function getAiMatch(): array
    {
        return $this->aiMatch;
    }

    /**
     * @param NetRate[] $aiMatch
     */
    public function setAiMatch(array $aiMatch): void
    {
        if ($aiMatch === []) {
            throw new InvalidArgumentException('Argument "aiMatch" cannot be empty');
        }

        foreach ($aiMatch as $netRate) {
            if (!$netRate instanceof NetRate) {
                throw new InvalidArgumentException('Argument "aiMatch" must contain only NetRate objects');
            }
        }

        $this->aiMatch = $aiMatch;
    }

    /**
     * @return NetRate[]
     */
    public function getSuggestionMatch(): array
    {
        return $this->suggestionMatch;
    }

    /**
     * @param NetRate[] $suggestionMatch
     */
    public function setSuggestionMatch(array $suggestionMatch): void
    {
        if ($suggestionMatch === []) {
            throw new InvalidArgumentException('Argument "suggestionMatch" cannot be empty');
        }

        foreach ($suggestionMatch as $netRate) {
            if (!$netRate instanceof NetRate) {
                throw new InvalidArgumentException('Argument "suggestionMatch" must contain only NetRate objects');
            }
        }

        $this->suggestionMatch = $suggestionMatch;
    }

    public function toArray(): array
    {
        return [
            'tmMatch' => array_map(static function (NetRate $netRate): array {
                return $netRate->toArray();
            }, $this->tmMatch),
            'mtMatch' => array_map(static function (NetRate $netRate): array {
                return $netRate->toArray();
            }, $this->mtMatch),
            'aiMatch' => array_map(static function (NetRate $netRate): array {
                return $netRate->toArray();
            }, $this->aiMatch),
            'suggestionMatch' => array_map(static function (NetRate $netRate): array {
                return $netRate->toArray();
            }, $this->suggestionMatch),
        ];
    }
}
