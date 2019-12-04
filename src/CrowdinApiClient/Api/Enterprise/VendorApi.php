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
     * List Vendors
     * @link https://support.crowdin.com/enterprise/api/#operation/api.vendors.getMany API Documentation
     *
     * @param array $params
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('vendors', Vendor::class, $params);
    }
}
