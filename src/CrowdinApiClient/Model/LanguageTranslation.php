<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class LanguageTranslation extends BaseModel
{
    /**
     * @var int
     */
    protected $stringId;

    /**
     * @var string
     */
    protected $contentType;

    /**
     * @var int
     */
    protected $translationId;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var array
     */
    protected $plurals;

    /**
     * LanguageTranslation constructor
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->stringId = (int)$this->getDataProperty('stringId');
        $this->contentType = (string)$this->getDataProperty('contentType');
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

    public function getPlurals(): array
    {
        return $this->plurals;
    }

    public function setPlurals(array $plurals): void
    {
        $this->plurals = $plurals;
    }

}
