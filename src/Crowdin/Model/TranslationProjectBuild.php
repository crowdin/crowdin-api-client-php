<?php

namespace Crowdin\Model;

/**
 * Class TranslationProjectBuild
 * @package Crowdin\Model
 */
class TranslationProjectBuild extends BaseModel
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
     * @var integer
     */
    protected $branchId;

    /**
     * @var array
     */
    protected $languagesId;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var array
     */
    protected $progress;

    /**
     * TranslationProjectBuild constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (integer)$this->getDataProperty('id');
        $this->projectId = (integer)$this->getDataProperty('projectId');
        $this->branchId = (integer)$this->getDataProperty('branchId');
        $this->languagesId = (array)$this->getDataProperty('languagesId');
        $this->status = (string)$this->getDataProperty('status');
        $this->progress = (array)$this->getDataProperty('progress');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     */
    public function setProjectId(int $projectId): void
    {
        $this->projectId = $projectId;
    }

    /**
     * @return int
     */
    public function getBranchId(): int
    {
        return $this->branchId;
    }

    /**
     * @param int $branchId
     */
    public function setBranchId(int $branchId): void
    {
        $this->branchId = $branchId;
    }

    /**
     * @return array
     */
    public function getLanguagesId(): array
    {
        return $this->languagesId;
    }

    /**
     * @param array $languagesId
     */
    public function setLanguagesId(array $languagesId): void
    {
        $this->languagesId = $languagesId;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getProgress(): array
    {
        return $this->progress;
    }

    /**
     * @param array $progress
     */
    public function setProgress(array $progress): void
    {
        $this->progress = $progress;
    }
}
