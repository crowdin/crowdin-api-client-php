<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\ProjectPermission;
use CrowdinApiClient\Model\Project;
use PHPUnit\Framework\TestCase;

class ProjectPermissionTest extends TestCase
{
    public function testLoadData(): void
    {
        $permission = new ProjectPermission([
            'id' => 2,
            'roles' => [['name' => 'translator', 'permissions' => ['allLanguages' => true]]],
            'project' => ['id' => 2, 'name' => 'Knowledge Base'],
            'teams' => [['id' => 1, 'name' => 'Translators']],
        ]);

        $this->assertSame(2, $permission->getId());
        $this->assertSame('translator', $permission->getRoles()[0]['name']);
        $this->assertInstanceOf(Project::class, $permission->getProject());
        $this->assertSame('Knowledge Base', $permission->getProject()->getName());
        $this->assertSame([['id' => 1, 'name' => 'Translators']], $permission->getTeams());
    }

    public function testLoadDataWithoutTeams(): void
    {
        $permission = new ProjectPermission(['id' => 2, 'roles' => [], 'project' => ['id' => 2]]);

        $this->assertSame([], $permission->getTeams());
    }
}
