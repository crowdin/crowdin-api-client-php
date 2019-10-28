<?php


namespace Crowdin\Model;

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

    public function __construct(array $data = [])
    {
        parent::__construct($data);

    }
}
