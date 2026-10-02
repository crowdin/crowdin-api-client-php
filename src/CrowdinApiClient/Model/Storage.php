<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Storage extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $fileName;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->id = (int)$this->getDataProperty('id');
        $this->fileName = (string)$this->getDataProperty('fileName');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }
}
