<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\SystemPlaceholder;
use CrowdinApiClient\ModelCollection;

class SystemPlaceholderApiTest extends AbstractTestApi
{
    public function testList(): void
    {
        $this->mockRequestGet(
            '/projects/2/system-placeholders?limit=10',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 'bracesDouble',
                            'isEnabled' => true,
                            'label' => '{{…}}',
                            'examples' => ['{{name}}'],
                            'description' => 'Double curly braces',
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 10,
                ],
            ])
        );

        $placeholders = $this->crowdin->systemPlaceholder->list(2, ['limit' => 10]);

        $this->assertInstanceOf(ModelCollection::class, $placeholders);
        $this->assertCount(1, $placeholders);
        $this->assertInstanceOf(SystemPlaceholder::class, $placeholders[0]);
        $this->assertEquals('bracesDouble', $placeholders[0]->getId());
    }

    public function testBatchOperations(): void
    {
        $data = [
            ['op' => 'replace', 'path' => '/bracesDouble/isEnabled', 'value' => false],
        ];

        $this->mockRequest([
            'path' => '/projects/2/system-placeholders',
            'method' => 'patch',
            'body' => json_encode($data),
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 'bracesDouble',
                            'isEnabled' => false,
                            'label' => '{{…}}',
                            'examples' => ['{{name}}'],
                            'description' => 'Double curly braces',
                        ],
                    ],
                ],
            ]),
        ]);

        $placeholders = $this->crowdin->systemPlaceholder->batchOperations(2, $data);

        $this->assertInstanceOf(ModelCollection::class, $placeholders);
        $this->assertCount(1, $placeholders);
        $this->assertFalse($placeholders[0]->isEnabled());
    }
}
