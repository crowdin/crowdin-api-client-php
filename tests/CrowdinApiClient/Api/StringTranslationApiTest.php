<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\LanguageTranslation;
use CrowdinApiClient\Model\StringTranslation;
use CrowdinApiClient\ModelCollection;

class StringTranslationApiTest extends AbstractTestApi
{
    public function testList(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/translations',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 190695,
                            'text' => 'Цю стрічку перекладено',
                            'pluralCategoryName' => 'few',
                            'user' => [
                                'id' => 19,
                                'login' => 'john_doe',
                            ],
                            'rating' => 10,
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

        $stringTranslations = $this->crowdin->stringTranslation->list(2);

        $this->assertInstanceOf(ModelCollection::class, $stringTranslations);
        $this->assertCount(1, $stringTranslations);
        $this->assertInstanceOf(StringTranslation::class, $stringTranslations[0]);
        $this->assertEquals(190695, $stringTranslations[0]->getId());
    }

    public function testGet(): void
    {
        $this->mockRequestGet(
            '/projects/2/translations/190695',
            json_encode([
                'data' => [
                    'id' => 190695,
                    'text' => 'Цю стрічку перекладено',
                    'pluralCategoryName' => 'few',
                    'user' => [
                        'id' => 19,
                        'login' => 'john_doe',
                    ],
                    'rating' => 10,
                ],
            ])
        );

        $stringTranslation = $this->crowdin->stringTranslation->get(2, 190695);

        $this->assertInstanceOf(StringTranslation::class, $stringTranslation);
        $this->assertEquals(190695, $stringTranslation->getId());
    }

    public function testDelete(): void
    {
        $this->mockRequestDelete('/projects/2/translations/190695');
        $this->crowdin->stringTranslation->delete(2, 190695);
    }

    public function testRestore(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/translations/190695',
            'method' => 'put',
            'response' => json_encode([
                'data' => [
                    'id' => 190695,
                    'text' => 'Цю стрічку перекладено',
                    'pluralCategoryName' => 'few',
                    'user' => [
                        'id' => 19,
                        'login' => 'john_doe',
                    ],
                    'rating' => 10,
                ],
            ]),
        ]);

        $stringTranslation = $this->crowdin->stringTranslation->restore(2, 190695);

        $this->assertInstanceOf(StringTranslation::class, $stringTranslation);
        $this->assertEquals(190695, $stringTranslation->getId());
    }

    public function testCreate(): void
    {
        $params = [
            'stringId' => 35434,
            'languageId' => 'uk',
            'text' => 'Цю стрічку перекладено',
            'pluralCategoryName' => 'few',
        ];

        $this->mockRequest([
            'path' => '/projects/2/translations',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'id' => 190695,
                    'text' => 'Цю стрічку перекладено',
                    'pluralCategoryName' => 'few',
                    'user' => [
                        'id' => 19,
                        'login' => 'john_doe',
                    ],
                    'rating' => 10,
                ],
            ]),
        ]);

        $stringTranslation = $this->crowdin->stringTranslation->create(2, $params);

        $this->assertInstanceOf(StringTranslation::class, $stringTranslation);
        $this->assertEquals(190695, $stringTranslation->getId());
    }

    public function deleteStringTranslationsDataProvider(): array
    {
        return [
            'withLanguageId' => [
                'path' => '/projects/1/translations?stringId=1&languageId=en',
                'projectId' => 1,
                'stringId' => 1,
                'languageId' => 'en',
            ],
            'withoutLanguageId' => [
                'path' => '/projects/1/translations?stringId=1',
                'projectId' => 1,
                'stringId' => 1,
                'languageId' => null,
            ],
        ];
    }

    /**
     * @dataProvider deleteStringTranslationsDataProvider
     */
    public function testDeleteStringTranslations(string $path, int $projectId, int $stringId, ?string $languageId): void
    {
        $this->mockRequestDelete($path);
        $this->crowdin->stringTranslation->deleteStringTranslations($projectId, $stringId, $languageId);
    }

    public function testDeleteStringApprovals(): void
    {
        $this->mockRequestDelete('/projects/2/approvals?stringId=12');
        $this->crowdin->stringTranslation->deleteStringApprovals(2, 12);
    }

    public function testListLanguageTranslations(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/languages/en/translations',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'stringId' => 12,
                            'contentType' => 'text/plain',
                            'translationId' => 1,
                            'text' => 'Confirm New Password',
                        ],
                    ],
                    [
                        'data' => [
                            'stringId' => 7815,
                            'contentType' => 'application/vnd.crowdin.text+plural',
                            'translationId' => 2,
                            'text' => 'Confirm New Password',
                        ],
                    ],
                    [
                        'data' => [
                            'stringId' => 9011,
                            'contentType' => 'application/vnd.crowdin.text+icu',
                            'translationId' => 3,
                            'text' => 'Confirm New Password',
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

        $stringTranslations = $this->crowdin->stringTranslation->listLanguageTranslations(2, 'en');

        $this->assertInstanceOf(ModelCollection::class, $stringTranslations);
        $this->assertCount(3, $stringTranslations);
        $this->assertInstanceOf(LanguageTranslation::class, $stringTranslations[0]);
        $this->assertInstanceOf(LanguageTranslation::class, $stringTranslations[1]);
        $this->assertInstanceOf(LanguageTranslation::class, $stringTranslations[2]);
        $this->assertEquals(12, $stringTranslations[0]->getStringId());
        $this->assertEquals(7815, $stringTranslations[1]->getStringId());
        $this->assertEquals(9011, $stringTranslations[2]->getStringId());
    }

    public function testBatchOperationsForApprovals(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/approvals',
            'method' => 'patch',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 12,
                            'user' => [
                                'id' => 12,
                                'username' => 'john_smith',
                                'fullName' => 'John Smith',
                                'userType' => 'translator'
                            ],
                            'translationId' => 190695,
                            'stringId' => 35434,
                            'languageId' => 'uk',
                            'workflowStepId' => 10,
                            'createdAt' => '2019-09-20T11:05:24+00:00'
                        ]
                    ]
                ]
            ])
        ]);

        $batchResult = $this->crowdin->stringTranslation->batchOperationsForApprovals(2, [
            [
                'op' => 'replace',
                'path' => '/12/workflowStepId',
                'value' => 10
            ]
        ]);

        $this->assertInstanceOf(\CrowdinApiClient\Model\StringTranslationApproval::class, $batchResult);
    }

    public function testBatchOperationsForTranslations(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/translations',
            'method' => 'patch',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 190695,
                            'text' => 'Updated translation text',
                            'pluralCategoryName' => 'few',
                            'user' => [
                                'id' => 19,
                                'login' => 'john_doe',
                            ],
                            'rating' => 10,
                        ]
                    ]
                ]
            ])
        ]);

        $batchResult = $this->crowdin->stringTranslation->batchOperationsForTranslations(2, [
            [
                'op' => 'replace',
                'path' => '/190695/text',
                'value' => 'Updated translation text'
            ]
        ]);

        $this->assertInstanceOf(StringTranslation::class, $batchResult);
    }
}
