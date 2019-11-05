<?php


namespace Crowdin\Api;


use Crowdin\Model\Vendor;

/**
 * Class VendorApi
 * @package Crowdin\Api
 */
class VendorApi extends AbstractApi
{
    /**
     * @param array $params
     * @return mixed
     */
    public function list(array $params = [])
    {
        return $this->_list('vendors', Vendor::class, $params);
    }
}
