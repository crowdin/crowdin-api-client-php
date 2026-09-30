<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\ProjectContribution;
use CrowdinApiClient\Model\Project;
use PHPUnit\Framework\TestCase;

class ProjectContributionTest extends TestCase
{
    public function testLoadData(): void
    {
        $contribution = new ProjectContribution([
            'id' => 2,
            'translated' => ['strings' => 10, 'words' => 42],
            'approved' => ['strings' => 3, 'words' => 12],
            'voted' => ['strings' => 1, 'words' => 4],
            'commented' => ['strings' => 2, 'words' => 0],
            'project' => ['id' => 2, 'name' => 'Knowledge Base'],
        ]);

        $this->assertSame(2, $contribution->getId());
        $this->assertSame(['strings' => 10, 'words' => 42], $contribution->getTranslated());
        $this->assertSame(['strings' => 3, 'words' => 12], $contribution->getApproved());
        $this->assertSame(['strings' => 1, 'words' => 4], $contribution->getVoted());
        $this->assertSame(['strings' => 2, 'words' => 0], $contribution->getCommented());
        $this->assertInstanceOf(Project::class, $contribution->getProject());
        $this->assertSame(2, $contribution->getProject()->getId());
    }
}
