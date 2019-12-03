<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\QaCheck;
use PHPUnit\Framework\TestCase;

class QaCheckTest extends TestCase
{
    /**
     * @var QaCheck
     */
    public $QaCheck;

    /**
     * @var array
     */
    public $data = [
        'stringId' => 1,
        'languageId' => 'uk',
        'category' => 'variables',
        'categoryDescription' => 'Variables mismatch',
        'validation' => 'python_variables_check',
        'validationDescription' => 'Variables mismatch',
        'pluralId' => 0,
        'text' => 'test',
    ];

    /**
     * @test
     */
    public function testLoadAndGetData()
    {
        $this->QaCheck = new QaCheck($this->data);

        $this->assertEquals($this->data['stringId'], $this->QaCheck->getStringId());
        $this->assertEquals($this->data['languageId'], $this->QaCheck->getLanguageId());
        $this->assertEquals($this->data['category'], $this->QaCheck->getCategory());
        $this->assertEquals($this->data['categoryDescription'], $this->QaCheck->getCategoryDescription());
        $this->assertEquals($this->data['validation'], $this->QaCheck->getValidation());
        $this->assertEquals($this->data['validationDescription'], $this->QaCheck->getValidationDescription());
        $this->assertEquals($this->data['pluralId'], $this->QaCheck->getPluralId());
        $this->assertEquals($this->data['text'], $this->QaCheck->getText());
    }
}
