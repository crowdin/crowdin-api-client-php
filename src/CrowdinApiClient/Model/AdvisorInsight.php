<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class AdvisorInsight extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $inspectorKey;

    /** @var string|null */
    protected $category;

    /** @var bool */
    protected $isDismissed;

    /** @var string */
    protected $status;

    /** @var string|null */
    protected $outcome;

    /** @var string|null */
    protected $severity;

    /** @var string|null */
    protected $refreshPolicy;

    /** @var array */
    protected $metrics;

    /** @var array */
    protected $recommendations;

    /** @var string|null */
    protected $checkedAt;

    /** @var array|null */
    protected $lastAiRun;

    /** @var array|null */
    protected $payload;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->inspectorKey = (string)$this->getDataProperty('inspectorKey');
        $this->category = $this->nullableString('category');
        $this->isDismissed = (bool)$this->getDataProperty('isDismissed');
        $this->status = (string)$this->getDataProperty('status');
        $this->outcome = $this->nullableString('outcome');
        $this->severity = $this->nullableString('severity');
        $this->refreshPolicy = $this->nullableString('refreshPolicy');
        $this->metrics = (array)$this->getDataProperty('metrics');
        $this->recommendations = (array)$this->getDataProperty('recommendations');
        $this->checkedAt = $this->nullableString('checkedAt');
        $this->lastAiRun = $this->nullableArray('lastAiRun');
        $this->payload = $this->nullableArray('payload');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getInspectorKey(): string
    {
        return $this->inspectorKey;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function isDismissed(): bool
    {
        return $this->isDismissed;
    }

    /**
     * Dismiss or reactivate the insight; send with AdvisorApi::updateInsight()
     */
    public function setIsDismissed(bool $isDismissed): void
    {
        $this->isDismissed = $isDismissed;
    }

    /**
     * @return string pending, checking, outdated or done
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string|null flagged, clear or not_applicable
     */
    public function getOutcome(): ?string
    {
        return $this->outcome;
    }

    /**
     * @return string|null high, medium or low
     */
    public function getSeverity(): ?string
    {
        return $this->severity;
    }

    /**
     * @return string|null hourly or daily
     */
    public function getRefreshPolicy(): ?string
    {
        return $this->refreshPolicy;
    }

    /**
     * @return array list of key, value, unit, threshold, tone, source, checkedAt
     */
    public function getMetrics(): array
    {
        return $this->metrics;
    }

    /**
     * @return array list of id, primary, params
     */
    public function getRecommendations(): array
    {
        return $this->recommendations;
    }

    public function getCheckedAt(): ?string
    {
        return $this->checkedAt;
    }

    /**
     * @return array|null mode, promptId, at
     */
    public function getLastAiRun(): ?array
    {
        return $this->lastAiRun;
    }

    public function getPayload(): ?array
    {
        return $this->payload;
    }
}
