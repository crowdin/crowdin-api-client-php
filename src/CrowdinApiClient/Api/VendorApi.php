<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Vendor;
use CrowdinApiClient\ModelCollection;

/**
 * Class VendorApi
 * @package Crowdin\Api
 */
class VendorApi extends AbstractApi
{
    /**
     * @param array $params
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('vendors', Vendor::class, $params);
    }
}
