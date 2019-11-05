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
     * @return mixed
     */
    public function list()
    {
        return $this->_list('vendors', Vendor::class);
    }
}
