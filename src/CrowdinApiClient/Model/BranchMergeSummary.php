<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class BranchMergeSummary extends BaseModel
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @var integer
     */
    protected $sourceBranchId;

    /**
     * @var integer
     */
    protected $targetBranchId;

    /**
     * @var bool
     */
    protected $dryRun;

    /**
     * @var bool
     */
    protected $acceptSourceChanges;

    /**
     * @var array
     */
    protected $details;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->status = (string)$this->getDataProperty('status');
        $this->sourceBranchId = (int)$this->getDataProperty('sourceBranchId');
        $this->targetBranchId = (int)$this->getDataProperty('targetBranchId');
        $this->dryRun = (bool)$this->getDataProperty('dryRun');
        $this->acceptSourceChanges = (bool)$this->getDataProperty('acceptSourceChanges');
        $this->details = (array)$this->getDataProperty('details');
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getSourceBranchId(): int
    {
        return $this->sourceBranchId;
    }

    public function getTargetBranchId(): int
    {
        return $this->targetBranchId;
    }

    public function isDryRun(): bool
    {
        return $this->dryRun;
    }

    public function isAcceptSourceChanges(): bool
    {
        return $this->acceptSourceChanges;
    }

    public function getDetails(): array
    {
        return $this->details;
    }
}
