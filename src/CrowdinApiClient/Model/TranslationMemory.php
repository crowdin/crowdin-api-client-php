<?php

namespace CrowdinApiClient\Model;

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
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
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
     * @return int
     */
    public function getSegmentsCount(): int
    {
        return $this->segmentsCount;
    }

    /**
     * @return int
     */
    public function getDefaultProjectId(): int
    {
        return $this->defaultProjectId;
    }

    /**
     * @return array
     */
    public function getProjectIds(): array
    {
        return $this->projectIds;
    }
}
