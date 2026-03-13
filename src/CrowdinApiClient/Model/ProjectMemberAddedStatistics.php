<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class ProjectMemberAddedStatistics extends BaseModel
{
    /**
     * @var array
     */
    protected $skipped;

    /**
     * @var array
     */
    protected $updated;

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
        $this->updated = (array)$this->getDataProperty('updated');
        $this->added = (array)$this->getDataProperty('added');
        $this->pagination = (array)$this->getDataProperty('pagination');
    }

    public function getSkipped(): array
    {
        return $this->skipped;
    }

    public function getUpdated(): array
    {
        return $this->updated;
    }

    public function getAdded(): array
    {
        return $this->added;
    }

    public function getPagination(): array
    {
        return $this->pagination;
    }
}
