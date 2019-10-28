<?php


namespace Crowdin\Model;

/**
 * Class Vote
 * @package Crowdin\Model
 */
class Vote extends BaseModel
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
     * @var string
     */
    protected $votedAt;

    /**
     * @var string
     */
    protected $mark;

    /**
     * Vote constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = $this->getDataProperty('id');
        $this->user = $this->getDataProperty('user');
        $this->translationId = $this->getDataProperty('translationId');
        $this->votedAt = $this->getDataProperty('votedAt');
        $this->mark = $this->getDataProperty('mark');
    }
}
