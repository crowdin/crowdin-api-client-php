<?php


namespace Crowdin\Model;

/**
 * Class StringTranslation
 * @package Crowdin\Model
 */
class StringTranslation extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $pluralCategoryName;

    /**
     * @var array
     */
    protected $user;

    /**
     * @var integer
     */
    protected $rating;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = $this->getDataProperty('id');
        $this->text = $this->getDataProperty('text');
        $this->pluralCategoryName = $this->getDataProperty('pluralCategoryName');
        $this->user = $this->getDataProperty('user');
        $this->rating = $this->getDataProperty('rating');
    }
}
