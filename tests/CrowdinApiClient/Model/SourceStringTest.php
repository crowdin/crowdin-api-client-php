<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\SourceString;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class SourceStringTest extends TestCase
{
    /**
     * @var SourceString
     */
    public $sourceString;

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
    ];

    public function testLoadData(): void
    {
        $this->sourceString = new SourceString($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->sourceString = new SourceString();
        $this->sourceString->setText($this->data['text']);
        $this->sourceString->setContext($this->data['context']);
        $this->sourceString->setMaxLength($this->data['maxLength']);
        $this->sourceString->setIsHidden($this->data['isHidden']);
        $this->sourceString->setLabelIds($this->data['labelIds']);

        $this->assertEquals($this->data['text'], $this->sourceString->getText());
        $this->assertEquals($this->data['context'], $this->sourceString->getContext());
        $this->assertEquals($this->data['maxLength'], $this->sourceString->getMaxLength());
        $this->assertEquals($this->data['isHidden'], $this->sourceString->isHidden());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['id'], $this->sourceString->getId());
        $this->assertEquals($this->data['projectId'], $this->sourceString->getProjectId());
        $this->assertEquals($this->data['fileId'], $this->sourceString->getFileId());
        $this->assertEquals($this->data['branchId'], $this->sourceString->getBranchId());
        $this->assertEquals($this->data['directoryId'], $this->sourceString->getDirectoryId());
        $this->assertEquals($this->data['identifier'], $this->sourceString->getIdentifier());
        $this->assertEquals($this->data['text'], $this->sourceString->getText());
        $this->assertEquals($this->data['type'], $this->sourceString->getType());
        $this->assertEquals($this->data['context'], $this->sourceString->getContext());
        $this->assertEquals($this->data['maxLength'], $this->sourceString->getMaxLength());
        $this->assertEquals($this->data['isHidden'], $this->sourceString->isHidden());
        $this->assertEquals($this->data['revision'], $this->sourceString->getRevision());
        $this->assertEquals($this->data['hasPlurals'], $this->sourceString->isHasPlurals());
        $this->assertEquals($this->data['hasPlurals'], $this->sourceString->isPlural());
        $this->assertEquals($this->data['isIcu'], $this->sourceString->isIcu());
        $this->assertEquals($this->data['labelIds'], $this->sourceString->getLabelIds());
        $this->assertEquals($this->data['createdAt'], $this->sourceString->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->sourceString->getUpdatedAt());
        $this->assertEquals($this->data['isDuplicate'], $this->sourceString->isDuplicate());
        $this->assertEquals($this->data['masterStringId'], $this->sourceString->getMasterStringId());
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
