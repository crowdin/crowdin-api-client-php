<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Tag extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $screenshotId;

    /**
     * @var integer
     */
    protected $stringId;

    /**
     * @var array
     */
    protected $position;

    /**
     * @var string
     */
    protected $createdAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->id = (int)$this->getDataProperty('id');
        $this->screenshotId = (int)$this->getDataProperty('screenshotId');
        $this->stringId = (int)$this->getDataProperty('stringId');
        $this->position = (array)$this->getDataProperty('position');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getScreenshotId(): int
    {
        return $this->screenshotId;
    }

    public function getStringId(): int
    {
        return $this->stringId;
    }

    public function setStringId(int $stringId): void
    {
        $this->stringId = $stringId;
    }

    public function getPosition(): array
    {
        return $this->position;
    }

    public function setPosition(array $position): void
    {
        $this->position = $position;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
