<?php

namespace CrowdinApiClient\Model;

/**
 * Class FileRevision
 * @package Crowdin\Model
 */
class FileRevision extends BaseModel
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
    protected $fileId;

    /**
     * @var integer
     */
    protected $restoreToRevision;

    /**
     * @var array
     */
    protected $info = [];

    /**
     * @var string
     */
    protected $date;

    /**
     * FileRevision constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->id = (integer)$this->getDataProperty('id');
        $this->projectId = (integer)$this->getDataProperty('projectId');
        $this->restoreToRevision = (integer)$this->getDataProperty('restoreToRevision');
        $this->fileId = (integer)$this->getDataProperty('fileId');
        $this->info = (array)$this->getDataProperty('info');
        $this->date = (string)$this->getDataProperty('date');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return array
     */
    public function getInfo(): array
    {
        return $this->info;
    }

    /**
     * @param array $info
     */
    public function setInfo(array $info): void
    {
        $this->info = $info;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getFileId(): int
    {
        return $this->fileId;
    }

    /**
     * @return int
     */
    public function getRestoreToRevision(): int
    {
        return $this->restoreToRevision;
    }
}
