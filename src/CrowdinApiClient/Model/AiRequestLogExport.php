<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class AiRequestLogExport extends AiReport
{
    /** @var string|null */
    protected $eta;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->eta = $this->nullableString('eta');
    }

    public function getEta(): ?string
    {
        return $this->eta;
    }
}
