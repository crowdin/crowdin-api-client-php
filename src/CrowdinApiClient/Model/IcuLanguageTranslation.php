<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * Class IcuLanguageTranslation
 * @package CrowdinApiClient\Model
 */
class IcuLanguageTranslation extends LanguageTranslation
{
    /**
     * @var string
     */
    protected $contentType = 'application/vnd.crowdin.text+icu';

    /**
     * @var int
     */
    protected $translationId;

    /**
     * @var string
     */
    protected $text;

    /**
     * IcuLanguageTranslation constructor
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->translationId = (int)$this->getDataProperty('translationId');
        $this->text = (string)$this->getDataProperty('text');
    }

    public function getTranslationId(): int
    {
        return $this->translationId;
    }

    public function setTranslationId(int $translationId): void
    {
        $this->translationId = $translationId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}
