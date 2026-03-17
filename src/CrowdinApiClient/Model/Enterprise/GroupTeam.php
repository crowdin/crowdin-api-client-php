<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

/**
 * @package Crowdin\Model\Enterprise
 */
class GroupTeam extends BaseModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var Team
     */
    protected $team;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->team = new Team((array)$this->getDataProperty('team'));
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTeam(): Team
    {
        return $this->team;
    }
}
