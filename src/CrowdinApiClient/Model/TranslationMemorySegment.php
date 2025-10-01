<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class TranslationMemorySegment extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var TranslationMemorySegmentRecord[]
     */
    protected $records;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (integer)$this->getDataProperty('id');
        $this->records = array_map(static function (array $record): TranslationMemorySegmentRecord {
            return new TranslationMemorySegmentRecord($record);
        }, (array)$this->getDataProperty('records'));
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
     * @return TranslationMemorySegmentRecord[]
     */
    public function getRecords(): array
    {
        return $this->records;
    }

    /**
     * @param TranslationMemorySegmentRecord[] $records
     */
    public function setRecords(array $records): void
    {
        $this->records = $records;
    }
}
