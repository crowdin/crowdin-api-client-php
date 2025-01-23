<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

use InvalidArgumentException;

/**
 * @package Crowdin\Model
 */
class IndividualRates extends BaseModel
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
    protected $fullTranslation;

    /**
     * @var float
     */
    protected $proofread;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->languageIds = array_map(static function ($languageId): string {
            return (string)$languageId;
        }, $this->getDataProperty('languageIds') ?? []);
        $this->userIds = array_map(static function ($userId): int {
            return (int)$userId;
        }, $this->getDataProperty('userIds') ?? []);
        $this->fullTranslation = (float)$this->getDataProperty('fullTranslation');
        $this->proofread = (float)$this->getDataProperty('proofread');
    }

    /**
     * @return string[]
     */
    public function getLanguageIds(): array
    {
        return $this->languageIds;
    }

    /**
     * @param array $languageIds
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
            'languageIds' => $this->languageIds,
            'userIds' => $this->userIds,
            'fullTranslation' => $this->fullTranslation,
            'proofread' => $this->proofread,
        ];
    }
}
