<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class ApplicationKvRecord extends BaseModel
{
    /** @var string */
    protected $key;

    /** @var mixed Any JSON value: string, number, boolean, array or object */
    protected $value;

    /** @var bool */
    protected $secret;

    /** @var string */
    protected $createdAt;

    /** @var string */
    protected $updatedAt;

    /** @var string|null */
    protected $expiresAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->key = (string)$this->getDataProperty('key');
        $this->value = $this->getDataProperty('value');
        $this->secret = (bool)$this->getDataProperty('secret');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
        $this->expiresAt = $this->nullableString('expiresAt');
    }

    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function isSecret(): bool
    {
        return $this->secret;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getExpiresAt(): ?string
    {
        return $this->expiresAt;
    }
}
