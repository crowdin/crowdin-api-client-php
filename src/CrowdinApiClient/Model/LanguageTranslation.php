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
}
