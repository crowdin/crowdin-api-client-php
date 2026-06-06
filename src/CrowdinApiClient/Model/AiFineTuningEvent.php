<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class AiFineTuningEvent extends BaseModel
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $type;

    /** @var string */
    protected $message;

    /** @var array|null */
    protected $metrics;

    /** @var string */
    protected $createdAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (string)$this->getDataProperty('id');
        $this->type = (string)$this->getDataProperty('type');
        $this->message = (string)$this->getDataProperty('message');
        $this->metrics = $this->getDataProperty('data');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getMetrics(): ?array
    {
        return $this->metrics;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
