<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\Vendor;
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
