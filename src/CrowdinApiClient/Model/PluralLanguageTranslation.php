<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * Class PluralLanguageTranslation
 * @package CrowdinApiClient\Model
 */
class PluralLanguageTranslation extends LanguageTranslation
{
    /**
     * @var string
     */
    protected $contentType = 'application/vnd.crowdin.text+plural';

    /**
     * @var array
     */
    protected $plurals;

    /**
     * PluralLanguageTranslation constructor
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->plurals = (array)$this->getDataProperty('plurals');
    }

    public function getPlurals(): array
    {
        return $this->plurals;
    }

    public function setPlurals(array $plurals): void
    {
        $this->plurals = $plurals;
    }
}
