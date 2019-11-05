<?php


namespace Crowdin\Model;

/**
 * Class Report
 * @package Crowdin\Model
 */
class Report extends BaseModel
{
    protected $pk = 'reportId';

    /**
     * @var string
     */
    protected $reportId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $report;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->reportId = (string)$this->getDataProperty('reportId');
        $this->name = (string)$this->getDataProperty('name');
        $this->report = (array)$this->getDataProperty('report');
    }

    /**
     * @return string
     */
    public function getReportId(): string
    {
        return $this->reportId;
    }

    /**
     * @param string $reportId
     */
    public function setReportId(string $reportId): void
    {
        $this->reportId = $reportId;
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
    public function getReport(): array
    {
        return $this->report;
    }

    /**
     * @param array $report
     */
    public function setReport(array $report): void
    {
        $this->report = $report;
    }
}
