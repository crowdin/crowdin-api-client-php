<?php

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

/**
 * @package Crowdin\Model\Enterprise
 */
class AddedProjectTeamInfo extends BaseModel
{
    /**
     * @var ProjectTeam|array
     */
    protected $skipped = [];

    /**
     * @var ProjectTeam|array
     */
    protected $added = [];

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->skipped = $this->getDataProperty('skipped') ? new ProjectTeam((array)$this->getDataProperty('skipped')) : [];
        $this->added = $this->getDataProperty('added') ? new ProjectTeam((array)$this->getDataProperty('added')) : [];
    }

    /**
     * @return array|ProjectTeam
     */
    public function getSkipped()
    {
        return $this->skipped;
    }

    /**
     * @param ProjectTeam $skipped
     */
    public function setSkipped(ProjectTeam $skipped): void
    {
        $this->skipped = $skipped;
    }

    /**
     * @return array|ProjectTeam
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * @param ProjectTeam $added
     */
    public function setAdded(ProjectTeam $added): void
    {
        $this->added = $added;
    }
}
