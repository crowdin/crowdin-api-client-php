<?php


namespace Crowdin\Model;

/**
 * Class Webhook
 * @package Crowdin\Model
 */
class Webhook extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $projectId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $events;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var array
     */
    protected $payload;

    /**
     * @var bool
     */
    protected $isActive;

    /**
     * @var string
     */
    protected $requestType;

    /**
     * @var string
     */
    protected $contentType;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * Webhook constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = $this->getDataProperty('id');
        $this->projectId = $this->getDataProperty('projectId');
        $this->name = $this->getDataProperty('name');
        $this->url = $this->getDataProperty('url');
        $this->events = $this->getDataProperty('events');
        $this->headers = $this->getDataProperty('headers');
        $this->payload = $this->getDataProperty('payload');
        $this->isActive = (bool)$this->getDataProperty('isActive');
        $this->requestType = (string)$this->getDataProperty('requestType');
        $this->contentType = (string)$this->getDataProperty('contentType');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
    }
}
