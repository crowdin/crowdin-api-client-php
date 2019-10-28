<?php


namespace Crowdin\Model;

/**
 * Class Tag
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
        $this->id = $this->getDataProperty('id');
        $this->screenshotId = $this->getDataProperty('screenshotId');
        $this->stringId = $this->getDataProperty('stringId');
        $this->position = $this->getDataProperty('position');
        $this->createdAt = $this->getDataProperty('createdAt');
    }
}
