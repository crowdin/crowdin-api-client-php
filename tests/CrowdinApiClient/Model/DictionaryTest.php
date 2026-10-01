<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Dictionary;
use PHPUnit\Framework\TestCase;

class DictionaryTest extends TestCase
{
    public function testLoadData(): void
    {
        $dictionary = new Dictionary(['languageId' => 'uk', 'words' => ['Crowdin', 'localization']]);

        $this->assertSame('uk', $dictionary->getLanguageId());
        $this->assertSame(['Crowdin', 'localization'], $dictionary->getWords());
    }

    public function testLoadDataWithoutWords(): void
    {
        $this->assertSame([], (new Dictionary(['languageId' => 'uk']))->getWords());
    }
}
