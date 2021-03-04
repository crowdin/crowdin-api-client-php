<?php

namespace CrowdinApiClient\Model;

class TaskForUpdate extends Task
{
    /**
     * @var boolean
     */
    protected $splitFiles;

    /**
     * @var boolean
     */
    protected $skipAssignedStrings;

    /**
     * @var string
     */
    protected $dateFrom;

    /**
     * @var string
     */
    protected $dateTo;

    /**
     * @var int[]
     */
    protected $labelIds;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->splitFiles = null === $this->getDataProperty('splitFiles')
            ? (bool)$this->getDataProperty('splitFiles') : null;
        $this->skipAssignedStrings = null === $this->getDataProperty('skipAssignedStrings')
            ? (bool)$this->getDataProperty('skipAssignedStrings') : null;
        $this->dateFrom = null === $this->getDataProperty('dateFrom')
            ? (string)$this->getDataProperty('dateFrom') : null;
        $this->dateTo = null === $this->getDataProperty('dateTo')
            ? (string)$this->getDataProperty('dateTo') : null;
        $this->labelIds = null === $this->getDataProperty('labelIds')
            ? (string)$this->getDataProperty('labelIds') : null;
    }

    /**
     * @return bool
     */
    public function isSplitFiles(): ?bool
    {
        return $this->splitFiles;
    }

    /**
     * @param bool $splitFiles
     */
    public function setSplitFiles(bool $splitFiles): void
    {
        $this->splitFiles = $splitFiles;
        $this->data['splitFiles'] = $splitFiles;
    }

    /**
     * @return bool
     */
    public function isSkipAssignedStrings(): ?bool
    {
        return $this->skipAssignedStrings;
    }

    /**
     * @param bool $skipAssignedStrings
     */
    public function setSkipAssignedStrings(bool $skipAssignedStrings): void
    {
        $this->skipAssignedStrings = $skipAssignedStrings;
        $this->data['skipAssignedStrings'] = $skipAssignedStrings;
    }

    /**
     * @return string
     */
    public function getDateFrom(): ?string
    {
        return $this->dateFrom;
    }

    /**
     * @param string $dateFrom
     */
    public function setDateFrom(string $dateFrom): void
    {
        $this->dateFrom = $dateFrom;
        $this->data['dateFrom'] = $dateFrom;
    }

    /**
     * @return string
     */
    public function getDateTo(): ?string
    {
        return $this->dateTo;
    }

    /**
     * @param string $dateTo
     */
    public function setDateTo(string $dateTo): void
    {
        $this->dateTo = $dateTo;
        $this->data['dateTo'] = $dateTo;
    }

    /**
     * @return int[]|null
     */
    public function getLabelIds(): ?array
    {
        return $this->labelIds;
    }

    /**
     * @param int[] $labelIds
     */
    public function setLabelIds(array $labelIds): void
    {
        $this->labelIds = $labelIds;
        $this->data['labelIds'] = $labelIds;
    }
}
