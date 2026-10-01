<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

class Organization extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $domain;

    /** @var string */
    protected $name;

    /** @var string|null */
    protected $logo;

    /** @var string */
    protected $defaultLogo;

    /** @var string|null */
    protected $description;

    /** @var string|null */
    protected $internalDescription;

    /** @var string|null */
    protected $cname;

    /** @var bool */
    protected $isVendor;

    /** @var string */
    protected $defaultPublicProjectsView;

    /** @var array */
    protected $plan;

    /** @var array */
    protected $defaults;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->domain = (string)$this->getDataProperty('domain');
        $this->name = (string)$this->getDataProperty('name');
        $this->logo = $this->nullableString('logo');
        $this->defaultLogo = (string)$this->getDataProperty('defaultLogo');
        $this->description = $this->nullableString('description');
        $this->internalDescription = $this->nullableString('internalDescription');
        $this->cname = $this->nullableString('cname');
        // The spec types isVendor as a string; FILTER_VALIDATE_BOOLEAN keeps "false" false, unlike a (bool) cast
        $this->isVendor = filter_var($this->getDataProperty('isVendor'), FILTER_VALIDATE_BOOLEAN);
        $this->defaultPublicProjectsView = (string)$this->getDataProperty('defaultPublicProjectsView');
        $this->plan = (array)$this->getDataProperty('plan');
        $this->defaults = (array)$this->getDataProperty('defaults');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function getDefaultLogo(): string
    {
        return $this->defaultLogo;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getInternalDescription(): ?string
    {
        return $this->internalDescription;
    }

    public function getCname(): ?string
    {
        return $this->cname;
    }

    public function isVendor(): bool
    {
        return $this->isVendor;
    }

    /**
     * @return string grid or list
     */
    public function getDefaultPublicProjectsView(): string
    {
        return $this->defaultPublicProjectsView;
    }

    /**
     * @return array name, wordsLimit, managersLimit
     */
    public function getPlan(): array
    {
        return $this->plan;
    }

    /**
     * @return array list of name, isLocked, defaultValue
     */
    public function getDefaults(): array
    {
        return $this->defaults;
    }
}
