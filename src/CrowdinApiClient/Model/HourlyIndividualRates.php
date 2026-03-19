<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

use InvalidArgumentException;

/**
 * @package Crowdin\Model
 */
class HourlyIndividualRates extends BaseModel
{
    /**
     * @var string[]
     */
    protected $languageIds;

    /**
     * @var int[]
     */
    protected $userIds;

    /**
     * @var float
     */
    protected $hourly;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->languageIds = array_map(static function ($languageId): string {
            return (string)$languageId;
        }, $this->getDataProperty('languageIds') ?? []);
        $this->userIds = array_map(static function ($userId): int {
            return (int)$userId;
        }, $this->getDataProperty('userIds') ?? []);
        $this->hourly = (float)$this->getDataProperty('hourly');
    }

    /**
     * @return string[]
     */
    public function getLanguageIds(): array
    {
        return $this->languageIds;
    }

    /**
     * @param string[] $languageIds
     */
    public function setLanguageIds(array $languageIds): void
    {
        if ($languageIds === []) {
            throw new InvalidArgumentException('Argument "languageIds" cannot be empty');
        }

        foreach ($languageIds as $languageId) {
            if (!is_string($languageId)) {
                throw new InvalidArgumentException('Argument "languageIds" must be an array of strings');
            }
        }

        $this->languageIds = $languageIds;
    }

    /**
     * @return int[]
     */
    public function getUserIds(): array
    {
        return $this->userIds;
    }

    /**
     * @param int[] $userIds
     */
    public function setUserIds(array $userIds): void
    {
        if ($userIds === []) {
            throw new InvalidArgumentException('Argument "userIds" cannot be empty');
        }

        foreach ($userIds as $userId) {
            if (!is_int($userId)) {
                throw new InvalidArgumentException('Argument "userIds" must be an array of integers');
            }
        }

        $this->userIds = $userIds;
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
            'languageIds' => $this->languageIds,
            'userIds' => $this->userIds,
            'hourly' => $this->hourly,
        ];
    }
}
