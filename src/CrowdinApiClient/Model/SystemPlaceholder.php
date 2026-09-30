<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class SystemPlaceholder extends BaseModel
{
    /** @var string */
    protected $id;

    /** @var bool */
    protected $isEnabled;

    /** @var string */
    protected $label;

    /** @var string[] */
    protected $examples;

    /** @var string */
    protected $description;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (string)$this->getDataProperty('id');
        $this->isEnabled = (bool)$this->getDataProperty('isEnabled');
        $this->label = (string)$this->getDataProperty('label');
        $this->examples = (array)$this->getDataProperty('examples');
        $this->description = (string)$this->getDataProperty('description');
    }

    /**
     * @return string e.g. bracesDouble, printfSpecifier
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string[]
     */
    public function getExamples(): array
    {
        return $this->examples;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
