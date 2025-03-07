<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Glossary;
use CrowdinApiClient\Model\GlossaryExport;
use CrowdinApiClient\ModelCollection;

class GlossaryApiTest extends AbstractTestApi
{
    public function testList(): void
    {
        $this->mockRequest([
            'path' => '/glossaries',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 2,
                            'name' => "Be My Eyes iOS's Glossary",
                            'groupId' => 2,
                            'userId' => 2,
                            'terms' => 25,
                            'languageIds' => ['ro'],
                            'projectIds' => [6],
                            'createdAt' => '2019-09-16T13:42:04+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 0,
                ],
            ]),
        ]);

        $glossaries = $this->crowdin->glossary->list();

        $this->assertInstanceOf(ModelCollection::class, $glossaries);
        $this->assertCount(1, $glossaries);
        $this->assertInstanceOf(Glossary::class, $glossaries[0]);
        $this->assertEquals(2, $glossaries[0]->getId());
    }

    public function testCreate(): void
    {
        $params = [
            'name' => 'Be My Eyes iOS\'s Glossary',
            'groupId' => 2,
        ];

        $this->mockRequest([
            'path' => '/glossaries',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'id' => 2,
                    'name' => "Be My Eyes iOS's Glossary",
                    'groupId' => 2,
                    'userId' => 2,
                    'terms' => 25,
                    'languageIds' => ['ro'],
                    'projectIds' => [6],
                    'createdAt' => '2019-09-16T13:42:04+00:00',
                ],
            ]),
        ]);

        $glossary = $this->crowdin->glossary->create($params);

        $this->assertInstanceOf(Glossary::class, $glossary);
        $this->assertEquals(2, $glossary->getId());
    }

    public function testGetAndUpdate(): void
    {
        $this->mockRequestGet(
            '/glossaries/2',
            json_encode([
                'data' => [
                    'id' => 2,
                    'name' => "Be My Eyes iOS's Glossary",
                    'groupId' => 2,
                    'userId' => 2,
                    'terms' => 25,
                    'languageIds' => ['ro'],
                    'projectIds' => [6],
                    'createdAt' => '2019-09-16T13:42:04+00:00',
                ],
            ])
        );

        $glossary = $this->crowdin->glossary->get(2);

        $this->assertInstanceOf(Glossary::class, $glossary);
        $this->assertEquals(2, $glossary->getId());

        $glossary->setName('edit test');

        $this->mockRequestPatch(
            '/glossaries/2',
            json_encode([
                'data' => [
                    'id' => 2,
                    'name' => 'edit test',
                    'groupId' => 2,
                    'userId' => 2,
                    'terms' => 25,
                    'languageIds' => ['ro'],
                    'projectIds' => [6],
                    'createdAt' => '2019-09-16T13:42:04+00:00',
                ],
            ])
        );

        $glossary = $this->crowdin->glossary->update($glossary);

        $this->assertInstanceOf(Glossary::class, $glossary);
        $this->assertEquals(2, $glossary->getId());
        $this->assertEquals('edit test', $glossary->getName());
    }

    public function testDelete(): void
    {
        $this->mockRequestDelete('/glossaries/2');
        $this->crowdin->glossary->delete(2);
    }

    public function testExport(): void
    {
        $this->mockRequest([
            'path' => '/glossaries/2/exports',
            'method' => 'post',
            'body' => json_encode([
                'format' => 'csv',
                'exportFields' => ['term', 'description', 'partOfSpeech'],
            ]),
            'response' => json_encode([
                'data' => [
                    'identifier' => '5ed2ce93-6d47-4402-9e66-516ca835cb20',
                    'status' => 'created',
                    'progress' => 0,
                    'attributes' => [
                        'format' => 'csv',
                        'exportFields' => ['term', 'description', 'partOfSpeech'],
                        'glossaryId' => 2,
                    ],
                    'createdAt' => '2019-09-23T07:06:43+00:00',
                    'updatedAt' => '2019-09-23T07:06:43+00:00',
                    'startedAt' => '2019-11-13T08:17:23Z',
                    'finishedAt' => '2019-11-13T08:17:23Z',
                ],
            ]),
        ]);

        $glossaryExport = $this->crowdin->glossary->export(2, 'csv', ['term', 'description', 'partOfSpeech']);

        $this->assertInstanceOf(GlossaryExport::class, $glossaryExport);
        $this->assertEquals('5ed2ce93-6d47-4402-9e66-516ca835cb20', $glossaryExport->getIdentifier());
    }

    public function testDownload(): void
    {
        $this->mockRequestGet(
            '/glossaries/2/exports/5ed2ce93-6d47-4402-9e66-516ca835cb20/download',
            json_encode([
                'data' => [
                    'url' => 'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
                    'expireIn' => '2019-09-20T10:31:21+00:00',
                ],
            ])
        );

        $downloadFile = $this->crowdin->glossary->download(2, '5ed2ce93-6d47-4402-9e66-516ca835cb20');

        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals(
            'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
            $downloadFile->getUrl()
        );
    }
}
