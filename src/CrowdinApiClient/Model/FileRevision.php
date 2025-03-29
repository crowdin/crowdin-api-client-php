<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class FileRevision extends BaseModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $projectId;

    /**
     * @var int
     */
    protected $fileId;

    /**
     * @var int|null
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

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->projectId = (int)$this->getDataProperty('projectId');
        $this->fileId = (int)$this->getDataProperty('fileId');
        $this->restoreToRevision = $this->getDataProperty('restoreToRevision')
            ? (int)$this->getDataProperty('restoreToRevision')
            : null;
        $this->info = (array)$this->getDataProperty('info');
        $this->date = (string)$this->getDataProperty('date');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }

    public function getFileId(): int
    {
        return $this->fileId;
    }

    public function getRestoreToRevision(): ?int
    {
        return $this->restoreToRevision;
    }

    public function getInfo(): array
    {
        return $this->info;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}
