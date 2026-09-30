<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\Client;
use CrowdinApiClient\ModelCollection;

/**
 * Clients are the organizations that invited your organization to be their vendor.
 *
 * @package Crowdin\Api\Enterprise
 */
class ClientApi extends AbstractApi
{
    /**
     * List Clients
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.clients.getMany API Documentation
     *
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('clients', Client::class, $params);
    }
}
