<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class AiProviderModel extends BaseModel
{
    /** @var string */
    protected $id;

    /** @var string|null */
    protected $provider;

    /** @var string|null */
    protected $providerName;

    /** @var int|null */
    protected $providerId;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (string)$this->getDataProperty('id');
        $this->provider = $this->getDataProperty('provider');
        $this->providerName = $this->getDataProperty('providerName');
        $this->providerId = $this->getDataProperty('providerId');
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProvider(): ?string
    {
        return $this->provider;
    }

    public function getProviderName(): ?string
    {
        return $this->providerName;
    }

    public function getProviderId(): ?int
    {
        return $this->providerId;
    }
}
