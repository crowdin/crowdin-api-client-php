<?php

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

/**
 * @package Crowdin\Model\Enterprise
 */
class ProjectTeamMemberAddedStatistics extends BaseModel
{
    /**
     * @var array
     */
    protected $skipped;

    /**
     * @var array
     */
    protected $added;

    /**
     * @var array
     */
    protected $pagination = [];

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->skipped = (array)$this->getDataProperty('skipped');
        $this->added = (array)$this->getDataProperty('added');
        $this->pagination = (array)$this->getDataProperty('pagination');
    }

    public function getSkipped(): array
    {
        return $this->skipped;
    }

    public function setSkipped(array $skipped): void
    {
        $this->skipped = $skipped;
    }

    public function getAdded(): array
    {
        return $this->added;
    }

    public function setAdded(array $added): void
    {
        $this->added = $added;
    }

    /**
     * @return array
     */
    public function getPagination(): array
    {
        return $this->pagination;
    }

    /**
     * @param array $pagination
     */
    public function setPagination(array $pagination): void
    {
        $this->pagination = $pagination;
    }
}
