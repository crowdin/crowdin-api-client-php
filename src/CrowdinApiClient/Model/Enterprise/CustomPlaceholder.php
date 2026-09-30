<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

class CustomPlaceholder extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var string|null */
    protected $description;

    /** @var string */
    protected $definition;

    /** @var string */
    protected $argumentDelimiter;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->description = $this->nullableString('description');
        $this->definition = (string)$this->getDataProperty('definition');
        $this->argumentDelimiter = (string)$this->getDataProperty('argumentDelimiter');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDefinition(): string
    {
        return $this->definition;
    }

    public function setDefinition(string $definition): void
    {
        $this->definition = $definition;
    }

    public function getArgumentDelimiter(): string
    {
        return $this->argumentDelimiter;
    }

    public function setArgumentDelimiter(string $argumentDelimiter): void
    {
        $this->argumentDelimiter = $argumentDelimiter;
    }
}
