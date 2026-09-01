<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Branch;
use CrowdinApiClient\Model\Directory;
use CrowdinApiClient\Model\File;
use CrowdinApiClient\Model\SourceString;
use CrowdinApiClient\Model\StringTranslation;
use CrowdinApiClient\ModelCollection;

class OrganizationSearchApiTest extends AbstractTestApi
{
    public function testSearchBranches(): void
    {
        $this->mockRequest([
            'path' => '/branches?filter=master',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 34,
                            'projectId' => 2,
                        ],
                    ],
                ],
            ]),
        ]);

        $branches = $this->crowdin->branch->search(['filter' => 'master']);

        $this->assertInstanceOf(ModelCollection::class, $branches);
        $this->assertInstanceOf(Branch::class, $branches[0]);
    }

    public function testSearchDirectories(): void
    {
        $this->mockRequest([
            'path' => '/directories?filter=main',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 4,
                            'projectId' => 2,
                        ],
                    ],
                ],
            ]),
        ]);

        $directories = $this->crowdin->directory->search(['filter' => 'main']);

        $this->assertInstanceOf(ModelCollection::class, $directories);
        $this->assertInstanceOf(Directory::class, $directories[0]);
    }

    public function testSearchFiles(): void
    {
        $this->mockRequest([
            'path' => '/files?filter=source',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 44,
                            'projectId' => 2,
                        ],
                    ],
                ],
            ]),
        ]);

        $files = $this->crowdin->file->search(['filter' => 'source']);

        $this->assertInstanceOf(ModelCollection::class, $files);
        $this->assertInstanceOf(File::class, $files[0]);
    }

    public function testSearchStrings(): void
    {
        $this->mockRequest([
            'path' => '/strings?filter=hello',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 2814,
                            'projectId' => 2,
                        ],
                    ],
                ],
            ]),
        ]);

        $sourceStrings = $this->crowdin->sourceString->search(['filter' => 'hello']);

        $this->assertInstanceOf(ModelCollection::class, $sourceStrings);
        $this->assertInstanceOf(SourceString::class, $sourceStrings[0]);
    }

    public function testSearchTranslations(): void
    {
        $this->mockRequest([
            'path' => '/translations?filter=translated',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 190695,
                            'projectId' => 2,
                            'stringId' => 2814,
                            'languageId' => 'uk',
                        ],
                    ],
                ],
            ]),
        ]);

        $stringTranslations = $this->crowdin->stringTranslation->search(['filter' => 'translated']);

        $this->assertInstanceOf(ModelCollection::class, $stringTranslations);
        $this->assertInstanceOf(StringTranslation::class, $stringTranslations[0]);
    }
}
