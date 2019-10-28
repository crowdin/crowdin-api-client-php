<?php


namespace Crowdin\Model;

/**
 * Class TranslationMemory
 * @package Crowdin\Model
 */
class TranslationMemory extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $groupId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $languageIds;

    /**
     * @var integer
     */
    protected $segmentsCount;

    /**
     * @var integer
     */
    protected $defaultProjectId;

    /**
     * @var array
     */
    protected $projectIds;

    /**
     * TranslationMemory constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = $this->getDataProperty('id');
        $this->groupId = $this->getDataProperty('groupId');
        $this->name = $this->getDataProperty('name');
        $this->languageIds = $this->getDataProperty('languageIds');
        $this->segmentsCount = $this->getDataProperty('segmentsCount');
        $this->defaultProjectId = $this->getDataProperty('defaultProjectId');
        $this->projectIds = $this->getDataProperty('projectIds');
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
    public function getGroupId(): int
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     */
    public function setGroupId(int $groupId): void
    {
        $this->groupId = $groupId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getLanguageIds(): array
    {
        return $this->languageIds;
    }

    /**
     * @param array $languageIds
     */
    public function setLanguageIds(array $languageIds): void
    {
        $this->languageIds = $languageIds;
    }

    /**
     * @return int
     */
    public function getSegmentsCount(): int
    {
        return $this->segmentsCount;
    }

    /**
     * @param int $segmentsCount
     */
    public function setSegmentsCount(int $segmentsCount): void
    {
        $this->segmentsCount = $segmentsCount;
    }

    /**
     * @return int
     */
    public function getDefaultProjectId(): int
    {
        return $this->defaultProjectId;
    }

    /**
     * @param int $defaultProjectId
     */
    public function setDefaultProjectId(int $defaultProjectId): void
    {
        $this->defaultProjectId = $defaultProjectId;
    }

    /**
     * @return array
     */
    public function getProjectIds(): array
    {
        return $this->projectIds;
    }

    /**
     * @param array $projectIds
     */
    public function setProjectIds(array $projectIds): void
    {
        $this->projectIds = $projectIds;
    }
}
