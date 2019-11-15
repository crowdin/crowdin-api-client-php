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
    protected $revision;

    /**
     * @var integer
     */
    protected $revertTo;

    /**
     * @var integer
     */
    protected $translationChunks;

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
        $this->revision = (integer)$this->getDataProperty('revision');
        $this->revertTo = (integer)$this->getDataProperty('revertTo');
        $this->translationChunks = (integer)$this->getDataProperty('translationChunks');
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
    public function getRevision(): int
    {
        return $this->revision;
    }

    /**
     * @param int $revision
     */
    public function setRevision(int $revision): void
    {
        $this->revision = $revision;
    }

    /**
     * @return int
     */
    public function getRevertTo(): int
    {
        return $this->revertTo;
    }

    /**
     * @param int $revertTo
     */
    public function setRevertTo(int $revertTo): void
    {
        $this->revertTo = $revertTo;
    }

    /**
     * @return int
     */
    public function getTranslationChunks(): int
    {
        return $this->translationChunks;
    }

    /**
     * @param int $translationChunks
     */
    public function setTranslationChunks(int $translationChunks): void
    {
        $this->translationChunks = $translationChunks;
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
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }
}
