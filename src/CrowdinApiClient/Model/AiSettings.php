<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class AiSettings extends BaseModel
{
    /** @var int */
    protected $preTranslationAiPromptId;

    /** @var int */
    protected $editorSuggestionAiPromptId;

    /** @var int|null */
    protected $qaCheckActionAiPromptId;

    /** @var int|null */
    protected $contextReviewAiPromptId;

    /** @var int|null */
    protected $alignmentActionAiPromptId;

    /** @var float|null */
    protected $dailyCostLimit;

    /** @var bool */
    protected $isLimitingActive;

    /** @var float|null */
    protected $monthlyCostLimit;

    /** @var array */
    protected $perUserOverrides;

    /** @var float|null */
    protected $userDailyCostLimit;

    /** @var float|null */
    protected $userMonthlyCostLimit;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->preTranslationAiPromptId = (int)$this->getDataProperty('preTranslationAiPromptId');
        $this->editorSuggestionAiPromptId = (int)$this->getDataProperty('editorSuggestionAiPromptId');
        $this->qaCheckActionAiPromptId = $this->getDataProperty('qaCheckActionAiPromptId');
        $this->contextReviewAiPromptId = $this->getDataProperty('contextReviewAiPromptId');
        $this->alignmentActionAiPromptId = $this->nullableInt('alignmentActionAiPromptId');
        $this->dailyCostLimit = $this->nullableFloat('dailyCostLimit');
        $this->isLimitingActive = (bool)$this->getDataProperty('isLimitingActive');
        $this->monthlyCostLimit = $this->nullableFloat('monthlyCostLimit');
        $this->perUserOverrides = (array)$this->getDataProperty('perUserOverrides');
        $this->userDailyCostLimit = $this->nullableFloat('userDailyCostLimit');
        $this->userMonthlyCostLimit = $this->nullableFloat('userMonthlyCostLimit');
    }

    public function getPreTranslationAiPromptId(): int
    {
        return $this->preTranslationAiPromptId;
    }

    public function getEditorSuggestionAiPromptId(): int
    {
        return $this->editorSuggestionAiPromptId;
    }

    public function getQaCheckActionAiPromptId(): ?int
    {
        return $this->qaCheckActionAiPromptId;
    }

    public function getContextReviewAiPromptId(): ?int
    {
        return $this->contextReviewAiPromptId;
    }

    public function setPreTranslationAiPromptId(int $preTranslationAiPromptId): void
    {
        $this->preTranslationAiPromptId = $preTranslationAiPromptId;
    }

    public function setEditorSuggestionAiPromptId(int $editorSuggestionAiPromptId): void
    {
        $this->editorSuggestionAiPromptId = $editorSuggestionAiPromptId;
    }

    public function setQaCheckActionAiPromptId(?int $qaCheckActionAiPromptId): void
    {
        $this->qaCheckActionAiPromptId = $qaCheckActionAiPromptId;
    }

    public function setContextReviewAiPromptId(?int $contextReviewAiPromptId): void
    {
        $this->contextReviewAiPromptId = $contextReviewAiPromptId;
    }

    public function getAlignmentActionAiPromptId(): ?int
    {
        return $this->alignmentActionAiPromptId;
    }

    public function setAlignmentActionAiPromptId(int $alignmentActionAiPromptId): void
    {
        $this->alignmentActionAiPromptId = $alignmentActionAiPromptId;
    }

    public function getDailyCostLimit(): ?float
    {
        return $this->dailyCostLimit;
    }

    public function setDailyCostLimit(float $dailyCostLimit): void
    {
        $this->dailyCostLimit = $dailyCostLimit;
    }

    public function isLimitingActive(): bool
    {
        return $this->isLimitingActive;
    }

    public function getMonthlyCostLimit(): ?float
    {
        return $this->monthlyCostLimit;
    }

    public function setMonthlyCostLimit(float $monthlyCostLimit): void
    {
        $this->monthlyCostLimit = $monthlyCostLimit;
    }

    public function getPerUserOverrides(): array
    {
        return $this->perUserOverrides;
    }

    public function getUserDailyCostLimit(): ?float
    {
        return $this->userDailyCostLimit;
    }

    public function setUserDailyCostLimit(float $userDailyCostLimit): void
    {
        $this->userDailyCostLimit = $userDailyCostLimit;
    }

    public function getUserMonthlyCostLimit(): ?float
    {
        return $this->userMonthlyCostLimit;
    }

    public function setUserMonthlyCostLimit(float $userMonthlyCostLimit): void
    {
        $this->userMonthlyCostLimit = $userMonthlyCostLimit;
    }
}
