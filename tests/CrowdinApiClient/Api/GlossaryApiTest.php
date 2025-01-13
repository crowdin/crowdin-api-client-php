<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Glossary;
use CrowdinApiClient\Model\GlossaryConcept;
use CrowdinApiClient\Model\GlossaryConcordance;
use CrowdinApiClient\Model\GlossaryExport;
use CrowdinApiClient\Model\GlossaryImport;
use CrowdinApiClient\Model\Term;
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
                    [
                        'offset' => 0,
                        'limit' => 0,
                    ],
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

        $glossary = $this->crowdin->glossary->create(['name' => 'Be My Eyes iOS\'s Glossary']);

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
                'format' => 'tbx',
                'exportFields' => ['term', 'description', 'partOfSpeech'],
            ]),
            'response' => json_encode([
                'data' => [
                    'identifier' => '5ed2ce93-6d47-4402-9e66-516ca835cb20',
                    'status' => 'created',
                    'progress' => 0,
                    'attributes' => [
                        'format' => 'csv',
                        'organizationId' => 200000299,
                        'glossaryId' => 6,
                    ],
                    'createdAt' => '2019-09-23T07:06:43+00:00',
                    'updatedAt' => '2019-09-23T07:06:43+00:00',
                    'startedAt' => '2019-11-13T08:17:23Z',
                    'finishedAt' => '2019-11-13T08:17:23Z',
                ],
            ]),
        ]);

        $glossaryExport = $this->crowdin->glossary->export(2);

        $this->assertInstanceOf(GlossaryExport::class, $glossaryExport);
        $this->assertEquals('5ed2ce93-6d47-4402-9e66-516ca835cb20', $glossaryExport->getIdentifier());
    }

    public function testGetExport(): void
    {
        $this->mockRequestGet(
            '/glossaries/2/exports/5ed2ce93-6d47-4402-9e66-516ca835cb20',
            json_encode([
                'data' => [
                    'identifier' => '5ed2ce93-6d47-4402-9e66-516ca835cb20',
                    'status' => 'completed',
                    'progress' => 100,
                    'attributes' => [
                        'format' => 'tbx',
                        'organizationId' => 200000299,
                        'glossaryId' => 2,
                    ],
                    'createdAt' => '2019-09-23T07:06:43+00:00',
                    'updatedAt' => '2019-09-23T07:06:43+00:00',
                    'startedAt' => '2019-11-13T08:17:23Z',
                    'finishedAt' => '2019-11-13T08:17:23Z',
                ],
            ])
        );

        $glossaryExport = $this->crowdin->glossary->getExport(2, '5ed2ce93-6d47-4402-9e66-516ca835cb20');

        $this->assertInstanceOf(GlossaryExport::class, $glossaryExport);
        $this->assertEquals('5ed2ce93-6d47-4402-9e66-516ca835cb20', $glossaryExport->getIdentifier());
        $this->assertEquals('completed', $glossaryExport->getStatus());
        $this->assertEquals(100, $glossaryExport->getProgress());
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

    public function testImport(): void
    {
        $data = [
            'storageId' => 2,
        ];

        $this->mockRequest([
            'path' => '/glossaries/2/imports',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => json_encode([
                'data' => [
                    'identifier' => 'c050fba2-200e-4ce1-8de4-f7ba8eb58732',
                    'status' => 'created',
                    'progress' => 0,
                    'attributes' => [
                        'storageId' => 36,
                        'scheme' => [
                            'term_en' => 0,
                            'description_en' => 1,
                        ],
                        'firstLineContainsHeader' => true,
                        'organizationId' => 200000299,
                        'userId' => 6,
                        'glossaryId' => 8,
                        'progressKey' => 'import_glossary_progress_8',
                    ],
                    'createdAt' => '2019-09-23T12:17:54+00:00',
                    'updatedAt' => '2019-09-23T12:17:54+00:00',
                    'startedAt' => '2019-12-04T13:14:36Z',
                    'finishedAt' => '2019-12-04T13:14:36Z',
                ],
            ]),
        ]);

        $import = $this->crowdin->glossary->import(2, $data);

        $this->assertInstanceOf(GlossaryImport::class, $import);
        $this->assertEquals('c050fba2-200e-4ce1-8de4-f7ba8eb58732', $import->getIdentifier());
    }

    public function testGetImport(): void
    {
        $this->mockRequestGet(
            '/glossaries/2/imports/c050fba2-200e-4ce1-8de4-f7ba8eb58732',
            json_encode([
                'data' => [
                    'identifier' => 'c050fba2-200e-4ce1-8de4-f7ba8eb58732',
                    'status' => 'created',
                    'progress' => 0,
                    'attributes' => [
                        'storageId' => 36,
                        'scheme' => [
                            'term_en' => 0,
                            'description_en' => 1,
                        ],
                        'firstLineContainsHeader' => true,
                        'organizationId' => 200000299,
                        'userId' => 6,
                        'glossaryId' => 8,
                        'progressKey' => 'import_glossary_progress_8',
                    ],
                    'createdAt' => '2019-09-23T12:17:54+00:00',
                    'updatedAt' => '2019-09-23T12:17:54+00:00',
                    'startedAt' => '2019-12-04T13:14:36Z',
                    'finishedAt' => '2019-12-04T13:14:36Z',
                ],
            ])
        );

        $import = $this->crowdin->glossary->getImport(2, 'c050fba2-200e-4ce1-8de4-f7ba8eb58732');

        $this->assertInstanceOf(GlossaryImport::class, $import);
        $this->assertEquals('c050fba2-200e-4ce1-8de4-f7ba8eb58732', $import->getIdentifier());
    }

    public function testConcordance(): void
    {
        $data = [
            'sourceLanguageId' => 'en',
            'targetLanguageId' => 'fr',
            'expressions' => [
                'Welcome!',
                'Save as...',
                'View',
                'About...'
            ],
        ];

        $this->mockRequest([
            'path' => '/projects/1/glossaries/concordance',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'glossary' => [
                                'id' => 2,
                                'name' => "Be My Eyes iOS's Glossary",
                            ],
                            'concept' => [
                                'id' => 8,
                                'subject' => 'general',
                                'definition' => 'Some definition',
                                'translatable' => true,
                                'note' => 'Any kind of note, such as a usage note, explanation, or instruction',
                                'url' => 'Base URL',
                                'figure' => 'Figure URL',
                            ],
                            'sourceTerms' => [
                                [
                                    'id' => 4,
                                    'userId' => 5,
                                    'glossaryId' => 6,
                                    'languageId' => 'fr',
                                    'text' => 'Voir',
                                    'description' => 'use for pages only (check screenshots)',
                                    'partOfSpeech' => 'verb',
                                    'status' => 'preferred',
                                    'type' => 'abbreviation',
                                    'gender' => 'masculine',
                                    'note' => 'Any kind of note, such as a usage note, explanation, or instruction',
                                    'url' => 'Base URL',
                                    'conceptId' => 8,
                                    'lemma' => 'voir',
                                    'createdAt' => '2019-09-23T07:19:47+00:00',
                                    'updatedAt' => '2019-09-23T07:19:47+00:00',
                                ],
                            ],
                            'targetTerms' => [
                                [
                                    'id' => 7,
                                    'userId' => 8,
                                    'glossaryId' => 9,
                                    'languageId' => 'fr',
                                    'text' => 'Voir',
                                    'description' => 'use for pages only (check screenshots)',
                                    'partOfSpeech' => 'verb',
                                    'status' => 'preferred',
                                    'type' => 'abbreviation',
                                    'gender' => 'masculine',
                                    'note' => 'Any kind of note, such as a usage note, explanation, or instruction',
                                    'url' => 'Base URL',
                                    'conceptId' => 8,
                                    'lemma' => 'voir',
                                    'createdAt' => '2019-09-23T07:19:47+00:00',
                                    'updatedAt' => '2019-09-23T07:19:47+00:00',
                                ],
                            ],
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ]),
        ]);

        /** @var GlossaryConcordance[] $concordance */
        $concordance = $this->crowdin->glossary->concordance(1, $data);

        $this->assertInstanceOf(ModelCollection::class, $concordance);
        $this->assertCount(1, $concordance);
        $this->assertEquals(2, $concordance[0]->getGlossary()['id']);
        $this->assertEquals(8, $concordance[0]->getConcept()['id']);
        $this->assertEquals(4, $concordance[0]->getSourceTerms()[0]->getId());
        $this->assertEquals(7, $concordance[0]->getTargetTerms()[0]->getId());
    }

    public function testListTerms(): void
    {
        $this->mockRequestGet(
            '/glossaries/2/terms',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 2,
                            'userId' => 6,
                            'glossaryId' => 6,
                            'languageId' => 'fr',
                            'text' => 'Voir',
                            'description' => 'use for pages only (check screenshots)',
                            'partOfSpeech' => 'verb',
                            'lemma' => 'voir',
                            'createdAt' => '2019-09-23T07:19:47+00:00',
                            'updatedAt' => '2019-09-23T07:19:47+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 25,
                    ],
                ],
            ])
        );

        $terms = $this->crowdin->glossary->listTerms(2);

        $this->assertInstanceOf(ModelCollection::class, $terms);
        $this->assertCount(1, $terms);
        $this->assertEquals(2, $terms[0]->getId());
    }

    public function testClearTerms(): void
    {
        $this->mockRequestDelete('/glossaries/2/terms');
        $this->crowdin->glossary->clearTerms(2);
    }

    public function testCreateTerm(): void
    {
        $data = [
            'languageId' => 'fr',
            'text' => 'Voir',
            'description' => 'use for pages only (check screenshots)',
            'partOfSpeech' => 'verb',
            'translationOfTermId' => 0,
        ];

        $this->mockRequest([
            'path' => '/glossaries/2/terms',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => json_encode([
                'data' => [
                    'id' => 2,
                    'userId' => 6,
                    'glossaryId' => 6,
                    'languageId' => 'fr',
                    'text' => 'Voir',
                    'description' => 'use for pages only (check screenshots)',
                    'partOfSpeech' => 'verb',
                    'lemma' => 'voir',
                    'createdAt' => '2019-09-23T07:19:47+00:00',
                    'updatedAt' => '2019-09-23T07:19:47+00:00',
                ],
            ]),
        ]);

        $term = $this->crowdin->glossary->createTerm(2, $data);

        $this->assertInstanceOf(Term::class, $term);
        $this->assertEquals(2, $term->getId());
    }

    public function testGetAndUpdateTerm(): void
    {
        $this->mockRequestGet(
            '/glossaries/2/terms/2',
            json_encode([
                'data' => [
                    'id' => 2,
                    'userId' => 6,
                    'glossaryId' => 2,
                    'languageId' => 'fr',
                    'text' => 'Voir',
                    'description' => 'use for pages only (check screenshots)',
                    'partOfSpeech' => 'verb',
                    'lemma' => 'voir',
                    'createdAt' => '2019-09-23T07:19:47+00:00',
                    'updatedAt' => '2019-09-23T07:19:47+00:00',
                ],
            ])
        );

        $term = $this->crowdin->glossary->getTerm(2, 2);

        $this->assertInstanceOf(Term::class, $term);
        $this->assertEquals(2, $term->getId());

        $this->mockRequestPatch(
            '/glossaries/2/terms/2',
            json_encode([
                'data' => [
                    'id' => 2,
                    'userId' => 6,
                    'glossaryId' => 2,
                    'languageId' => 'fr',
                    'text' => 'test',
                    'description' => 'use for pages only (check screenshots)',
                    'partOfSpeech' => 'verb',
                    'lemma' => 'voir',
                    'createdAt' => '2019-09-23T07:19:47+00:00',
                    'updatedAt' => '2019-09-23T07:19:47+00:00',
                ],
            ])
        );

        $term->setText('test');
        $term = $this->crowdin->glossary->updateTerm($term);

        $this->assertInstanceOf(Term::class, $term);
        $this->assertEquals(2, $term->getId());
        $this->assertEquals('test', $term->getText());
    }

    public function testDeleteTerm(): void
    {
        $this->mockRequestDelete('/glossaries/2/terms/1');
        $this->crowdin->glossary->deleteTerm(2, 1);
    }

    public function testListConcepts(): void
    {
        $this->mockRequestGet(
            '/glossaries/3/concepts',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 1,
                            'userId' => 2,
                            'glossaryId' => 3,
                            'subject' => 'Subject',
                            'definition' => 'Definition',
                            'translatable' => true,
                            'note' => 'Note',
                            'url' => 'URL',
                            'figure' => 'Figure',
                            'languagesDetails' => [
                                'languageId' => 'en',
                                'userId' => 12,
                                'definition' => 'Language definition',
                                'note' => 'Language note',
                                'createdAt' => '2019-09-19T14:14:00+00:00',
                                'updatedAt' => '2019-09-19T14:14:00+00:00',
                            ],
                            'createdAt' => '2019-09-16T13:42:04+00:00',
                            'updatedAt' => '2019-09-16T13:42:04+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 25,
                    ],
                ],
            ])
        );

        $concepts = $this->crowdin->glossary->listConcepts(3);

        $this->assertInstanceOf(ModelCollection::class, $concepts);
        $this->assertCount(1, $concepts->__toArray());
        $this->assertEquals(1, $concepts[0]->getId());
        $this->assertEquals(2, $concepts[0]->getUserId());
        $this->assertEquals(3, $concepts[0]->getGlossaryId());
    }

    public function testGetConcept(): void
    {
        $this->mockRequestGet(
            '/glossaries/3/concepts/1',
            json_encode([
                'data' => [
                    'id' => 1,
                    'userId' => 2,
                    'glossaryId' => 3,
                    'subject' => 'Subject',
                    'definition' => 'Definition',
                    'translatable' => true,
                    'note' => 'Note',
                    'url' => 'URL',
                    'figure' => 'Figure',
                    'languagesDetails' => [
                        'languageId' => 'en',
                        'userId' => 12,
                        'definition' => 'Language definition',
                        'note' => 'Language note',
                        'createdAt' => '2019-09-19T14:14:00+00:00',
                        'updatedAt' => '2019-09-19T14:14:00+00:00',
                    ],
                    'createdAt' => '2019-09-16T13:42:04+00:00',
                    'updatedAt' => '2019-09-16T13:42:04+00:00',
                ],
            ])
        );

        $concept = $this->crowdin->glossary->getConcept(3, 1);

        $this->assertInstanceOf(GlossaryConcept::class, $concept);
        $this->assertEquals(1, $concept->getId());
        $this->assertEquals('Subject', $concept->getSubject());
        $this->assertEquals('Definition', $concept->getDefinition());
    }

    public function testUpdateConcept(): void
    {
        $data = [
            'subject' => 'Updated Subject',
            'definition' => 'Updated Definition',
            'translatable' => true,
            'note' => 'Note',
            'url' => 'URL',
            'figure' => 'Figure',
            'languagesDetails' => [
                'languageId' => 'en',
                'definition' => 'Language definition',
                'note' => 'Language note',
            ],
        ];

        $this->mockRequestPut(
            '/glossaries/3/concepts/1',
            json_encode([
                'data' => [
                    'id' => 1,
                    'userId' => 2,
                    'glossaryId' => 2,
                    'subject' => 'Updated Subject',
                    'definition' => 'Updated Definition',
                    'translatable' => true,
                    'note' => 'Note',
                    'url' => 'URL',
                    'figure' => 'Figure',
                    'languagesDetails' => [
                        'languageId' => 'en',
                        'userId' => 12,
                        'definition' => 'Language definition',
                        'note' => 'Language note',
                        'createdAt' => '2019-09-19T14:14:00+00:00',
                        'updatedAt' => '2019-09-19T14:14:00+00:00',
                    ],
                    'createdAt' => '2019-09-16T13:42:04+00:00',
                    'updatedAt' => '2019-09-16T13:42:04+00:00',
                ],
            ])
        );

        $updatedConcept = $this->crowdin->glossary->updateConcept(3, 1, $data);

        $this->assertInstanceOf(GlossaryConcept::class, $updatedConcept);
        $this->assertEquals(1, $updatedConcept->getId());
        $this->assertEquals('Updated Subject', $updatedConcept->getSubject());
        $this->assertEquals('Updated Definition', $updatedConcept->getDefinition());
    }

    public function testDeleteConcept(): void
    {
        $this->mockRequestDelete('/glossaries/3/concepts/1');
        $this->crowdin->glossary->deleteConcept(3, 1);
    }
}
