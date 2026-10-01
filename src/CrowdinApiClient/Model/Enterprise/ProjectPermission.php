<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;
use CrowdinApiClient\Model\Project;

/**
 * Roles a user or team has in one project.
 */
class ProjectPermission extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var array */
    protected $roles;

    /** @var Project */
    protected $project;

    /** @var array */
    protected $teams;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->roles = (array)$this->getDataProperty('roles');
        $this->project = new Project((array)$this->getDataProperty('project'));
        $this->teams = (array)$this->getDataProperty('teams');
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array list of name, permissions
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @return array teams that grant the user access to the project; empty for team permissions
     */
    public function getTeams(): array
    {
        return $this->teams;
    }
}
