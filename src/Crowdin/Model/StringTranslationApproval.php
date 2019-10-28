<?php


namespace Crowdin\Model;

/**
 * Class StringTranslation
 * @package Crowdin\Model
 */
class StringTranslationApproval extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var array
     */
    protected $user;

    /**
     * @var integer
     */
    protected $translationId;

    /**
     * @var integer
     */
    protected $stringId;

    /**
     * @var string
     */
    protected $languageId;

    /**
     * @var integer
     */
    protected $workflowStepId;

    /**
     * @var string
     */
    protected $createdAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = $this->getDataProperty('id');
        $this->user = $this->getDataProperty('user');
        $this->translationId = $this->getDataProperty('translationId');
        $this->stringId = $this->getDataProperty('stringId');
        $this->languageId = $this->getDataProperty('languageId');
        $this->workflowStepId = $this->getDataProperty('workflowStepId');
        $this->createdAt = $this->getDataProperty('createdAt');
    }
}
