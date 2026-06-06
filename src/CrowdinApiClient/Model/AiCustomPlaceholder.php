<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @deprecated Use AiSnippet instead
 */
class AiCustomPlaceholder extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $description;

    /** @var string */
    protected $placeholder;

    /** @var string */
    protected $value;

    /** @var string */
    protected $createdAt;

    /** @var string */
    protected $updatedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->description = (string)$this->getDataProperty('description');
        $this->placeholder = (string)$this->getDataProperty('placeholder');
        $this->value = (string)$this->getDataProperty('value');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPlaceholder(): string
    {
        return $this->placeholder;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setPlaceholder(string $placeholder): void
    {
        $this->placeholder = $placeholder;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}
