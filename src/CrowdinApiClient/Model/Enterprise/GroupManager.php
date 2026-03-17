<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

/**
 * @package Crowdin\Model\Enterprise
 */
class GroupManager extends BaseModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Team[]
     */
    protected $teams = [];

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->user = new User((array)$this->getDataProperty('user'));

        foreach ($this->getDataProperty('teams') ?? [] as $team) {
            $this->teams[] = new Team($team);
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getTeams(): array
    {
        return $this->teams;
    }
}
