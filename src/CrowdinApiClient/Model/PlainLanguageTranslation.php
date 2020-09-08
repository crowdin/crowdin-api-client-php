<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * Class PlainLanguageTranslation
 * @package CrowdinApiClient\Model
 */
class PlainLanguageTranslation extends BaseModel
{
    /**
     * @var int
     */
    protected $stringId;

    /**
     * @var string
     */
    protected $contentType = 'text/plain';

    /**
     * @var int
     */
    protected $translationId;

    /**
     * @var string
     */
    protected $text;

    /**
     * PlainLanguageTranslation constructor
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->stringId = (int)$this->getDataProperty('stringId');
        $this->contentType = (string)$this->getDataProperty('contentType');
        $this->translationId = (int)$this->getDataProperty('translationId');
        $this->text = (string)$this->getDataProperty('text');
    }

    public function getStringId(): int
    {
        return $this->stringId;
    }

    public function setStringId(int $stringId): void
    {
        $this->stringId = $stringId;
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function setContentType(string $contentType): void
    {
        $this->contentType = $contentType;
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
