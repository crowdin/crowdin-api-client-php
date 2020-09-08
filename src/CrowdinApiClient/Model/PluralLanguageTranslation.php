<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * Class PluralLanguageTranslation
 * @package CrowdinApiClient\Model
 */
class PluralLanguageTranslation extends BaseModel
{
    /**
     * @var int
     */
    protected $stringId;

    /**
     * @var string
     */
    protected $contentType = 'application/vnd.crowdin.text+plural';

    /**
     * @var array
     */
    protected $plurals;

    /**
     * PluralLanguageTranslation constructor
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->stringId = (int)$this->getDataProperty('stringId');
        $this->contentType = (string)$this->getDataProperty('contentType');
        $this->plurals = (array)$this->getDataProperty('plurals');
    }


}
