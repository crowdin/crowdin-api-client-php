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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getScreenshotId(): int
    {
        return $this->screenshotId;
    }

    /**
     * @return int
     */
    public function getStringId(): int
    {
        return $this->stringId;
    }

    /**
     * @param int $stringId
     */
    public function setStringId(int $stringId): void
    {
        $this->stringId = $stringId;
    }

    /**
     * @return array
     */
    public function getPosition(): array
    {
        return $this->position;
    }

    /**
     * @param array $position
     */
    public function setPosition(array $position): void
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
