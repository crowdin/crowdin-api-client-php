<?php


namespace Crowdin\Model;

/**
 * Class Project
 * @package Crowdin\Model
 */
class Project extends BaseModel
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
     * @var integer
     */
    protected $userId;

    /**
     * @var integer
     */
    protected $sourceLanguageId;

    /**
     * @var array
     */
    protected $targetLanguageIds = [];

    /**
     * @var string
     */
    protected $joinPolicy;

    /**
     * @var string
     */
    protected $languageAccessPolicy;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $cname;

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $visibility;

    /**
     * @var string
     */
    protected $logo;

    /**
     * @var string
     */
    protected $background;

    /**
     * @var bool
     */
    protected $isExternal;

    /**
     * @var string
     */
    protected $externalType;

    /**
     * @var integer
     */
    protected $advancedWorkflowId;

    /**
     * @var bool
     */
    protected $hasCrowdSourcing;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

    }
}
