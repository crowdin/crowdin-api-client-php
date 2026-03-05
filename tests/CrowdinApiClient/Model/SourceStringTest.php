<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\SourceString;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class SourceStringTest extends TestCase
{
    public $data = [
        'id' => 2814,
        'projectId' => 2,
        'fileId' => 48,
        'branchId' => 4,
        'directoryId' => null,
        'identifier' => '6a1821e6499ebae94de4b880fd93b985',
        'text' => 'Not all videos are shown to users. See more',
        'type' => 'text',
        'context' => 'shown on main page',
        'maxLength' => 35,
        'isHidden' => false,
        'revision' => 1,
        'hasPlurals' => false,
        'isIcu' => false,
        'labelIds' => [1],
        'createdAt' => '2019-09-20T12:43:57+00:00',
        'updatedAt' => '2019-09-20T13:24:01+00:00',
        'isDuplicate' => true,
        'masterStringId' => 1234,
        'fields' => [
            'client-company' => 'ACME Corp',
        ],
    ];

    public function testLoadData(): void
    {
        $sourceString = new SourceString($this->data);
        $this->assertEquals($this->data['id'], $sourceString->getId());
        $this->assertEquals($this->data['projectId'], $sourceString->getProjectId());
        $this->assertEquals($this->data['fileId'], $sourceString->getFileId());
        $this->assertEquals($this->data['branchId'], $sourceString->getBranchId());
        $this->assertEquals($this->data['directoryId'], $sourceString->getDirectoryId());
        $this->assertEquals($this->data['identifier'], $sourceString->getIdentifier());
        $this->assertEquals($this->data['text'], $sourceString->getText());
        $this->assertEquals($this->data['type'], $sourceString->getType());
        $this->assertEquals($this->data['context'], $sourceString->getContext());
        $this->assertEquals($this->data['maxLength'], $sourceString->getMaxLength());
        $this->assertEquals($this->data['isHidden'], $sourceString->isHidden());
        $this->assertEquals($this->data['revision'], $sourceString->getRevision());
        $this->assertEquals($this->data['hasPlurals'], $sourceString->isHasPlurals());
        $this->assertEquals($this->data['hasPlurals'], $sourceString->isPlural());
        $this->assertEquals($this->data['isIcu'], $sourceString->isIcu());
        $this->assertEquals($this->data['labelIds'], $sourceString->getLabelIds());
        $this->assertEquals($this->data['createdAt'], $sourceString->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $sourceString->getUpdatedAt());
        $this->assertEquals($this->data['isDuplicate'], $sourceString->isDuplicate());
        $this->assertEquals($this->data['masterStringId'], $sourceString->getMasterStringId());
        $this->assertEquals($this->data['fields'], $sourceString->getFields());
    }

    public function testSetData(): void
    {
        $sourceString = new SourceString();
        $sourceString->setText($this->data['text']);
        $sourceString->setContext($this->data['context']);
        $sourceString->setMaxLength($this->data['maxLength']);
        $sourceString->setIsHidden($this->data['isHidden']);
        $sourceString->setLabelIds($this->data['labelIds']);
        $sourceString->setFields($this->data['fields']);

        $this->assertEquals($this->data['text'], $sourceString->getText());
        $this->assertEquals($this->data['context'], $sourceString->getContext());
        $this->assertEquals($this->data['maxLength'], $sourceString->getMaxLength());
        $this->assertEquals($this->data['isHidden'], $sourceString->isHidden());
        $this->assertEquals($this->data['fields'], $sourceString->getFields());
    }

    public function testSetPlainText(): void
    {
        $text = 'Updated plain text';

        $sourceString = new SourceString(['text' => 'Plain text']);
        $sourceString->setText($text);

        $this->assertSame($text, $sourceString->getText());
    }

    public function testSetPluralText(): void
    {
        $text = [
            'one' => 'Updated one',
            'other' => 'Updated other',
        ];

        $sourceString = new SourceString([
            'text' => [
                'one' => 'One',
                'other' => 'Other',
            ],
        ]);
        $sourceString->setText($text);

        $this->assertSame($text, $sourceString->getText());
    }

    public function textExceptionDataProvider(): array
    {
        return [
            'typeMismatchA' => [
                'originalText' => 'Plain text',
                'updatedText' => [
                    'one' => 'One',
                    'other' => 'Other',
                ],
                'expectedExceptionMessage' =>
                    'Argument "text" must have the same type as the current value. ' .
                    'Current value type: string',
            ],
            'typeMismatchB' => [
                'originalText' => [
                    'one' => 'One',
                    'other' => 'Other',
                ],
                'updatedText' => 'Plain text',
                'expectedExceptionMessage' =>
                    'Argument "text" must have the same type as the current value. ' .
                    'Current value type: array',
            ],
            'extraForm' => [
                'originalText' => [
                    'one' => 'One',
                    'other' => 'Other',
                ],
                'updatedText' => [
                    'one' => 'One',
                    'many' => 'Many',
                    'other' => 'Other',
                ],
                'expectedExceptionMessage' => 'Argument "text" must have the same keys as the current value',
            ],
            'missingForm' => [
                'originalText' => [
                    'one' => 'One',
                    'other' => 'Other',
                ],
                'updatedText' => [
                    'other' => 'Other',
                ],
                'expectedExceptionMessage' => 'Argument "text" must have the same keys as the current value',
            ],
        ];
    }

    /**
     * @dataProvider textExceptionDataProvider
     * @param string|array $originalText
     * @param string|array $updatedText
     * @param string $expectedExceptionMessage
     */
    public function testSetTextException($originalText, $updatedText, string $expectedExceptionMessage): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedExceptionMessage);

        $sourceString = new SourceString(['text' => $originalText]);
        $sourceString->setText($updatedText);
    }
}
