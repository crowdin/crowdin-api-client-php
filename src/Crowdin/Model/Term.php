<?php


namespace Crowdin\Model;

/**
 * Class Term
 * @package Crowdin\Model
 */
class Term extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $userId;

    /**
     * @var integer
     */
    protected $glossaryId;

    /**
     * @var string
     */
    protected $languageId;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $partOfSpeech;

    /**
     * @var string
     */
    protected $lemma;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * Term constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (integer)$this->getDataProperty('id');
        $this->userId = (integer)$this->getDataProperty('userId');
        $this->glossaryId = (integer)$this->getDataProperty('glossaryId');
        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->text = (string)$this->getDataProperty('text');
        $this->description = (string)$this->getDataProperty('description');
        $this->partOfSpeech = (string)$this->getDataProperty('partOfSpeech');
        $this->lemma = (string)$this->getDataProperty('lemma');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
    }
}
