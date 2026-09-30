<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\ProjectAiSettings;
use PHPUnit\Framework\TestCase;

class ProjectAiSettingsTest extends TestCase
{
    public function testLoadData(): void
    {
        $settings = new ProjectAiSettings([
            'editorSuggestionAiPromptId' => 6,
            'alignmentActionAiPromptId' => 7,
            'qaCheckActionAiPromptId' => '9',
            'contextReviewAiPromptId' => 12,
        ]);

        $this->assertSame(6, $settings->getEditorSuggestionAiPromptId());
        $this->assertSame(7, $settings->getAlignmentActionAiPromptId());
        $this->assertSame(9, $settings->getQaCheckActionAiPromptId());
        $this->assertSame(12, $settings->getContextReviewAiPromptId());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $settings = new ProjectAiSettings([]);

        $this->assertNull($settings->getEditorSuggestionAiPromptId());
        $this->assertNull($settings->getAlignmentActionAiPromptId());
        $this->assertNull($settings->getQaCheckActionAiPromptId());
        $this->assertNull($settings->getContextReviewAiPromptId());
    }
}
