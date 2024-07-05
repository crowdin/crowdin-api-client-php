<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
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
     * @var array|null
     */
    protected $user;

    /**
     * @var array
     */
    protected $plurals;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->stringId = (int)$this->getDataProperty('stringId');
        $this->contentType = (string)$this->getDataProperty('contentType');

        $this->translationId = $this->getDataProperty('translationId')
            ? (int)$this->getDataProperty('translationId') : null;
        $this->text = $this->getDataProperty('text')
            ? (string)$this->getDataProperty('text') : null;
        $this->plurals = $this->getDataProperty('plurals')
            ? (array)$this->getDataProperty('plurals') : null;
        $this->user = $this->getDataProperty('user')
            ? (array)$this->getDataProperty('user') : null;
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

    public function getTranslationId(): ?int
    {
        return $this->translationId;
    }

    public function setTranslationId(int $translationId): void
    {
        $this->translationId = $translationId;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getUser(): ?array
    {
        return $this->user;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getPlurals(): ?array
    {
        return $this->plurals;
    }

    public function setPlurals(array $plurals): void
    {
        $this->plurals = $plurals;
    }
}
