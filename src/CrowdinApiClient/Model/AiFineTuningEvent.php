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

    /**
     * The event's "data" field. Named differently because BaseModel::$data holds the raw payload;
     * safe since events are read-only and never sent through update().
     *
     * @var array
     */
    protected $eventData;

    /** @var string */
    protected $createdAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (string)$this->getDataProperty('id');
        $this->type = (string)$this->getDataProperty('type');
        $this->message = (string)$this->getDataProperty('message');
        $this->eventData = (array)$this->getDataProperty('data');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string message or metrics
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return array step, totalSteps, trainingLoss, validationLoss, fullValidationLoss
     */
    public function getEventData(): array
    {
        return $this->eventData;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
