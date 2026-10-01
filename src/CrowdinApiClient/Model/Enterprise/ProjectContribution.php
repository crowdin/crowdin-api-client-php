<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;
use CrowdinApiClient\Model\Project;

/**
 * A user's contribution counters in one project. Each counter holds strings and words.
 */
class ProjectContribution extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var array */
    protected $translated;

    /** @var array */
    protected $approved;

    /** @var array */
    protected $voted;

    /** @var array */
    protected $commented;

    /** @var Project */
    protected $project;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->translated = (array)$this->getDataProperty('translated');
        $this->approved = (array)$this->getDataProperty('approved');
        $this->voted = (array)$this->getDataProperty('voted');
        $this->commented = (array)$this->getDataProperty('commented');
        $this->project = new Project((array)$this->getDataProperty('project'));
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTranslated(): array
    {
        return $this->translated;
    }

    public function getApproved(): array
    {
        return $this->approved;
    }

    public function getVoted(): array
    {
        return $this->voted;
    }

    public function getCommented(): array
    {
        return $this->commented;
    }

    public function getProject(): Project
    {
        return $this->project;
    }
}
