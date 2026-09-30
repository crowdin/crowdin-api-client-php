<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class ProjectAiSettings extends BaseModel
{
    /** @var int|null */
    protected $editorSuggestionAiPromptId;

    /** @var int|null */
    protected $alignmentActionAiPromptId;

    /** @var int|null */
    protected $qaCheckActionAiPromptId;

    /** @var int|null */
    protected $contextReviewAiPromptId;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->editorSuggestionAiPromptId = $this->nullableInt('editorSuggestionAiPromptId');
        $this->alignmentActionAiPromptId = $this->nullableInt('alignmentActionAiPromptId');
        $this->qaCheckActionAiPromptId = $this->nullableInt('qaCheckActionAiPromptId');
        $this->contextReviewAiPromptId = $this->nullableInt('contextReviewAiPromptId');
    }

    public function getEditorSuggestionAiPromptId(): ?int
    {
        return $this->editorSuggestionAiPromptId;
    }

    /**
     * Crowdin Enterprise only
     */
    public function getAlignmentActionAiPromptId(): ?int
    {
        return $this->alignmentActionAiPromptId;
    }

    public function getQaCheckActionAiPromptId(): ?int
    {
        return $this->qaCheckActionAiPromptId;
    }

    public function getContextReviewAiPromptId(): ?int
    {
        return $this->contextReviewAiPromptId;
    }
}
