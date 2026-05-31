<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class ApplicationData extends BaseModel
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }
}
