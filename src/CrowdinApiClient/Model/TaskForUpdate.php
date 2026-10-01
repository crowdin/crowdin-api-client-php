<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class TaskForUpdate extends Task
{
    /**
     * @deprecated
     * @var bool
     */
    protected $splitFiles;

    /**
     * @var bool
     */
    protected $splitContent;

    /**
     * @var int[]
     */
    protected $stringIds;

    /**
     * @var bool
     */
    protected $skipAssignedStrings;

    /**
     * @var string|null
     */
    protected $dateFrom;

    /**
     * @var string|null
     */
    protected $dateTo;

    /**
     * @var string|null
     */
    protected $translationsUpdatedDateFrom;

    /**
     * @var string|null
     */
    protected $translationsUpdatedDateTo;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->initMissingProperties();

        $this->splitFiles = null !== $this->getDataProperty('splitFiles')
            && $this->getDataProperty('splitFiles');
        $this->splitContent = null !== $this->getDataProperty('splitContent')
            && $this->getDataProperty('splitContent');
        $this->stringIds = null !== $this->getDataProperty('stringIds')
            ? (array)$this->getDataProperty('stringIds')
            : [];
        $this->skipAssignedStrings = null !== $this->getDataProperty('skipAssignedStrings')
            && $this->getDataProperty('skipAssignedStrings');
        $this->dateFrom = $this->nullableString('dateFrom');
        $this->dateTo = $this->nullableString('dateTo');
        $this->translationsUpdatedDateFrom = $this->nullableString('translationsUpdatedDateFrom');
        $this->translationsUpdatedDateTo = $this->nullableString('translationsUpdatedDateTo');
    }

    private function initMissingProperties(): void
    {
        if (!array_key_exists('splitFiles', $this->data)) {
            $this->data['splitFiles'] = false;
        }

        if (!array_key_exists('splitContent', $this->data)) {
            $this->data['splitContent'] = false;
        }

        if (!array_key_exists('stringIds', $this->data)) {
            $this->data['stringIds'] = [];
        }

        if (!array_key_exists('skipAssignedStrings', $this->data)) {
            $this->data['skipAssignedStrings'] = false;
        }

        if (!array_key_exists('dateFrom', $this->data)) {
            $this->data['dateFrom'] = null;
        }

        if (!array_key_exists('dateTo', $this->data)) {
            $this->data['dateTo'] = null;
        }

        if (!array_key_exists('translationsUpdatedDateFrom', $this->data)) {
            $this->data['translationsUpdatedDateFrom'] = null;
        }

        if (!array_key_exists('translationsUpdatedDateTo', $this->data)) {
            $this->data['translationsUpdatedDateTo'] = null;
        }
    }

    /**
     * @deprecated Deprecated by the Crowdin API. Use getSplitContent() instead.
     * @return bool
     */
    public function getSplitFiles(): bool
    {
        return $this->splitFiles;
    }

    /**
     * @deprecated Deprecated by the Crowdin API. Use setSplitContent() instead.
     * @param bool $splitFiles
     */
    public function setSplitFiles(bool $splitFiles): void
    {
        $this->splitFiles = $splitFiles;
    }

    public function getSplitContent(): bool
    {
        return $this->splitContent;
    }

    public function setSplitContent(bool $splitContent): void
    {
        $this->splitContent = $splitContent;
    }

    public function getStringIds(): array
    {
        return $this->stringIds;
    }

    public function setStringIds(array $stringIds): void
    {
        $this->stringIds = $stringIds;
    }

    public function getSkipAssignedStrings(): bool
    {
        return $this->skipAssignedStrings;
    }

    public function setSkipAssignedStrings(bool $skipAssignedStrings): void
    {
        $this->skipAssignedStrings = $skipAssignedStrings;
    }

    public function getDateFrom(): ?string
    {
        return $this->dateFrom;
    }

    public function setDateFrom(string $dateFrom): void
    {
        $this->dateFrom = $dateFrom;
    }

    public function getDateTo(): ?string
    {
        return $this->dateTo;
    }

    public function setDateTo(string $dateTo): void
    {
        $this->dateTo = $dateTo;
    }

    public function getTranslationsUpdatedDateFrom(): ?string
    {
        return $this->translationsUpdatedDateFrom;
    }

    public function setTranslationsUpdatedDateFrom(?string $translationsUpdatedDateFrom): void
    {
        $this->translationsUpdatedDateFrom = $translationsUpdatedDateFrom;
    }

    public function getTranslationsUpdatedDateTo(): ?string
    {
        return $this->translationsUpdatedDateTo;
    }

    public function setTranslationsUpdatedDateTo(?string $translationsUpdatedDateTo): void
    {
        $this->translationsUpdatedDateTo = $translationsUpdatedDateTo;
    }
}
