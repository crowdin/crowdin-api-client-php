<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

class Client extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $description;

    /** @var string */
    protected $status;

    /** @var string */
    protected $webUrl;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->description = (string)$this->getDataProperty('description');
        $this->status = (string)$this->getDataProperty('status');
        $this->webUrl = (string)$this->getDataProperty('webUrl');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string pending, confirmed or rejected
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }
}
