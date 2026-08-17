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

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->preTranslationAiPromptId = (int)$this->getDataProperty('preTranslationAiPromptId');
        $this->editorSuggestionAiPromptId = (int)$this->getDataProperty('editorSuggestionAiPromptId');
        $this->qaCheckActionAiPromptId = $this->getDataProperty('qaCheckActionAiPromptId');
        $this->contextReviewAiPromptId = $this->getDataProperty('contextReviewAiPromptId');
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
}
