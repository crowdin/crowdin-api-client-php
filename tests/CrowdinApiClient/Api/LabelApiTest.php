<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Label;
use CrowdinApiClient\ModelCollection;

class LabelApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/labels',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 4,
                    "projectId": 2,
                    "title": "main"
                  }
                }
              ],
              "pagination": [
                {
                  "offset": 0,
                  "limit": 0
                }
              ]
            }'
        ]);

        $labels = $this->crowdin->label->list(2);

        $this->assertInstanceOf(ModelCollection::class, $labels);
        $this->assertCount(1, $labels);
        $this->assertInstanceOf(Label::class, $labels[0]);
        $this->assertEquals(4, $labels[0]->getId());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet('/projects/2/labels/34', '{
                  "data": {
                    "id": 34,
                    "projectId": 2,
                    "title": "develop-master"
                  }
            }');

        $label = $this->crowdin->label->get(2, 34);

        $this->assertInstanceOf(Label::class, $label);
        $this->assertEquals(34, $label->getId());

        $label->setTitle('edit-test');

        $this->mockRequestPath('/projects/2/labels/34', '{
                  "data": {
                    "id": 34,
                    "projectId": 2,
                    "name": "edit-test"
                  }
            }');

        $this->crowdin->label->update($label);
        $this->assertInstanceOf(Label::class, $label);
        $this->assertEquals(34, $label->getId());
        $this->assertEquals('edit-test', $label->getTitle());
    }

    public function testCreate()
    {
        $params = [
            'title' => 'develop-master',
        ];

        $this->mockRequest([
            'path' => '/projects/2/labels',
            'method' => 'post',
            'body' => $params,
            'response' => '{
                  "data": {
                    "id": 34,
                    "projectId": 2,
                    "title": "develop-master"
                  }
                }'
        ]);

        $label = $this->crowdin->label->create(2, $params);
        $this->assertInstanceOf(Label::class, $label);
        $this->assertEquals(34, $label->getId());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/labels/34');
        $this->crowdin->label->delete(2, 34);
    }
}
