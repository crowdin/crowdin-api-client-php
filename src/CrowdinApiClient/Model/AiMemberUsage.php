<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class AiMemberUsage extends BaseModel
{
    /** @var array */
    protected $user;

    /** @var float|null */
    protected $dailyCostLimit;

    /** @var float */
    protected $dailyCostSpent;

    /** @var string */
    protected $dailyResetAt;

    /** @var float|null */
    protected $monthlyCostLimit;

    /** @var float */
    protected $monthlyCostSpent;

    /** @var string */
    protected $monthlyResetAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->user = (array)$this->getDataProperty('user');
        $this->dailyCostLimit = $this->nullableFloat('dailyCostLimit');
        $this->dailyCostSpent = (float)$this->getDataProperty('dailyCostSpent');
        $this->dailyResetAt = (string)$this->getDataProperty('dailyResetAt');
        $this->monthlyCostLimit = $this->nullableFloat('monthlyCostLimit');
        $this->monthlyCostSpent = (float)$this->getDataProperty('monthlyCostSpent');
        $this->monthlyResetAt = (string)$this->getDataProperty('monthlyResetAt');
    }

    /**
     * @return array id, username, fullName, avatarUrl
     */
    public function getUser(): array
    {
        return $this->user;
    }

    public function getDailyCostLimit(): ?float
    {
        return $this->dailyCostLimit;
    }

    public function getDailyCostSpent(): float
    {
        return $this->dailyCostSpent;
    }

    public function getDailyResetAt(): string
    {
        return $this->dailyResetAt;
    }

    public function getMonthlyCostLimit(): ?float
    {
        return $this->monthlyCostLimit;
    }

    public function getMonthlyCostSpent(): float
    {
        return $this->monthlyCostSpent;
    }

    public function getMonthlyResetAt(): string
    {
        return $this->monthlyResetAt;
    }
}
