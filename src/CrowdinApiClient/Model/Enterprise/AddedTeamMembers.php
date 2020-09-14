<?php

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Collection;
use CrowdinApiClient\Model\BaseModel;

class AddedTeamMembers extends BaseModel
{
    /**
     * @var null|Collection
     */
    protected $skipped;

    /**
     * @var null|Collection
     */
    protected $added;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->skipped = new Collection();
        $this->added = new Collection();

        $skipped = $this->getDataProperty('skipped');
        if (is_array($skipped)) {
            foreach ($skipped as $item) {
                if (isset($item['data']) && is_array($item['data'])) {
                    $this->skipped->add(new TeamMember($item['data']));
                }
            }
        }

        $added = $this->getDataProperty('added');
        if (is_array($added)) {
            foreach ($added as $item) {
                if (isset($item['data']) && is_array($item['data'])) {
                    $this->added->add(new TeamMember($item['data']));
                }
            }
        }
    }

    public function getSkipped(): ?Collection
    {
        return $this->skipped;
    }

    public function setSkipped(Collection $skipped): void
    {
        $this->skipped = $skipped;
    }

    public function getAdded(): ?Collection
    {
        return $this->added;
    }

    public function setAdded(Collection $added): void
    {
        $this->added = $added;
    }
}
