<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Manager extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var array */
    protected $user;

    /** @var string */
    protected $status;

    /** @var bool */
    protected $isApplicationAgent;

    /** @var int[] */
    protected $projectIds;

    /** @var int[] */
    protected $tmIds;

    /** @var int[] */
    protected $projectDefaultTmIds;

    /** @var int[] */
    protected $glossaryIds;

    /** @var int[] */
    protected $projectDefaultGlossaryIds;

    /** @var int[] */
    protected $styleGuideIds;

    /** @var string|null */
    protected $createdAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->user = (array)$this->getDataProperty('user');
        $this->status = (string)$this->getDataProperty('status');
        $this->isApplicationAgent = (bool)$this->getDataProperty('isApplicationAgent');
        $this->projectIds = (array)$this->getDataProperty('projectIds');
        $this->tmIds = (array)$this->getDataProperty('tmIds');
        $this->projectDefaultTmIds = (array)$this->getDataProperty('projectDefaultTmIds');
        $this->glossaryIds = (array)$this->getDataProperty('glossaryIds');
        $this->projectDefaultGlossaryIds = (array)$this->getDataProperty('projectDefaultGlossaryIds');
        $this->styleGuideIds = (array)$this->getDataProperty('styleGuideIds');
        $this->createdAt = $this->nullableString('createdAt');
    }

    /**
     * @return int The same as the manager's user ID
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array id, username, fullName, avatarUrl. username is a masked email for an invited person without an account
     */
    public function getUser(): array
    {
        return $this->user;
    }

    /**
     * @return string active or pending
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    public function isApplicationAgent(): bool
    {
        return $this->isApplicationAgent;
    }

    /**
     * @return int[]
     */
    public function getProjectIds(): array
    {
        return $this->projectIds;
    }

    /**
     * @param int[] $projectIds Default TMs and glossaries of added projects are granted too
     */
    public function setProjectIds(array $projectIds): void
    {
        $this->projectIds = $projectIds;
    }

    /**
     * @return int[]
     */
    public function getTmIds(): array
    {
        return $this->tmIds;
    }

    /**
     * @param int[] $tmIds
     */
    public function setTmIds(array $tmIds): void
    {
        $this->tmIds = $tmIds;
    }

    /**
     * @return int[] Subset of tmIds that follow projectIds and can't be removed on their own
     */
    public function getProjectDefaultTmIds(): array
    {
        return $this->projectDefaultTmIds;
    }

    /**
     * @return int[]
     */
    public function getGlossaryIds(): array
    {
        return $this->glossaryIds;
    }

    /**
     * @param int[] $glossaryIds
     */
    public function setGlossaryIds(array $glossaryIds): void
    {
        $this->glossaryIds = $glossaryIds;
    }

    /**
     * @return int[] Subset of glossaryIds that follow projectIds and can't be removed on their own
     */
    public function getProjectDefaultGlossaryIds(): array
    {
        return $this->projectDefaultGlossaryIds;
    }

    /**
     * @return int[]
     */
    public function getStyleGuideIds(): array
    {
        return $this->styleGuideIds;
    }

    /**
     * @param int[] $styleGuideIds
     */
    public function setStyleGuideIds(array $styleGuideIds): void
    {
        $this->styleGuideIds = $styleGuideIds;
    }

    /**
     * @return string|null Null for managers added before this date was stored
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }
}
