<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

class ProjectPlaceholder extends BaseModel
{
    /** @var int|null */
    protected $id;

    /** @var int|null */
    protected $customPlaceholderId;

    /** @var string|null */
    protected $type;

    /** @var int|null */
    protected $index;

    /** @var bool|null */
    protected $isBlocking;

    /** @var string[] */
    protected $formats;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = $this->nullableInt('id');
        $this->customPlaceholderId = $this->nullableInt('customPlaceholderId');
        $this->type = $this->nullableString('type');
        $this->index = $this->nullableInt('index');
        $this->isBlocking = $this->nullableBool('isBlocking');
        $this->formats = (array)$this->getDataProperty('formats');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomPlaceholderId(): ?int
    {
        return $this->customPlaceholderId;
    }

    /**
     * @return string|null high or low
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type high or low
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getIndex(): ?int
    {
        return $this->index;
    }

    public function setIndex(int $index): void
    {
        $this->index = $index;
    }

    public function getIsBlocking(): ?bool
    {
        return $this->isBlocking;
    }

    public function setIsBlocking(bool $isBlocking): void
    {
        $this->isBlocking = $isBlocking;
    }

    /**
     * @return string[] empty means every file format
     */
    public function getFormats(): array
    {
        return $this->formats;
    }

    /**
     * @param string[] $formats empty means every file format
     */
    public function setFormats(array $formats): void
    {
        $this->formats = $formats;
    }
}
