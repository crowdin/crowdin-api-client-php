<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\Vendor;
use CrowdinApiClient\ModelCollection;

/**
 * Vendors are the organizations that provide professional translation services.
 * To assign a Vendor to a project workflow you should invite an existing Organization to be a Vendor for you.
 * Use API to get the list of the Vendors you already invited to your organization.
 *
 * @package Crowdin\Api\Enterprise
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
