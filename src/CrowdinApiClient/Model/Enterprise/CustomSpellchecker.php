<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

class CustomSpellchecker extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var array */
    protected $config;

    /** @var string */
    protected $createdAt;

    /** @var string|null */
    protected $updatedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->config = (array)$this->getDataProperty('config');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = $this->nullableString('updatedAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array identifier, key, realTimeCheckEnabled, enabledLanguageIds
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
}
