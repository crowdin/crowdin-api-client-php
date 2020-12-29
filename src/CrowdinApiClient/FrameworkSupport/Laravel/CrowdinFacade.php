<?php

namespace CrowdinApiClient\FrameworkSupport\Laravel;

use Illuminate\Support\Facades\Facade;

class CrowdinFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'crowdin';
    }
}
