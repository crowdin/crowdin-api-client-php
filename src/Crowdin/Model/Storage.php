<?php

namespace Crowdin\Model;

/**
 * Class Storage
 * @package Crowdin\Model
 */
class Storage extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->id = (integer)$this->getDataProperty('id');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
