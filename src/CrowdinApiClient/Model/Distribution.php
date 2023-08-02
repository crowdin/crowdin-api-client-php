<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Distribution extends BaseModel
{
    /**
     * @var string
     */
    protected $hash;

    /**
     * @var string
     */
    protected $exportMode;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int[]
     */
    protected $fileIds;

    /**
     * @var int[]
     */
    protected $bundleIds;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->hash = (string)$this->getDataProperty('hash');
        $this->exportMode = (string)$this->getDataProperty('exportMode');
        $this->name = (string)$this->getDataProperty('name');
        $this->fileIds = (array)$this->getDataProperty('fileIds');
        $this->bundleIds = (array)$this->getDataProperty('bundleIds');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    public function getExportMode(): string
    {
        return $this->exportMode;
    }

    public function setExportMode(string $exportMode): void
    {
        $this->exportMode = $exportMode;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getFileIds(): array
    {
        return $this->fileIds;
    }

    public function setFileIds(array $fileIds): void
    {
        $this->fileIds = $fileIds;
    }

    public function getBundleIds(): array
    {
        return $this->bundleIds;
    }

    public function setBundleIds(array $bundleIds): void
    {
        $this->bundleIds = $bundleIds;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
