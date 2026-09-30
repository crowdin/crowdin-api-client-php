<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\Organization;
use CrowdinApiClient\Model\Enterprise\OrganizationAuthSettings;

/**
 * @package Crowdin\Api\Enterprise
 */
class OrganizationApi extends AbstractApi
{
    /**
     * Get Organization Info
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.organization.get API Documentation
     *
     * @return Organization|null
     */
    public function get(): ?Organization
    {
        return $this->_get('organization', Organization::class);
    }

    /**
     * Get Organization Authentication Settings
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.organization.auth-settings.get API Documentation
     *
     * @return OrganizationAuthSettings|null
     */
    public function getAuthSettings(): ?OrganizationAuthSettings
    {
        return $this->_get('organization/auth-settings', OrganizationAuthSettings::class);
    }
}
