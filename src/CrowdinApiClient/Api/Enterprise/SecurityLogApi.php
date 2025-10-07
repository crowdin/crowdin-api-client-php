<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\SecurityLogApi as CrowdinSecurityLogApi;
use CrowdinApiClient\Model\SecurityLog;
use CrowdinApiClient\ModelCollection;

/**
 * Security Logs API gives you the possibility to get information about organization security activities.
 *
 * @package Crowdin\Api\Enterprise
 */
class SecurityLogApi extends CrowdinSecurityLogApi
{
    /**
     * List Organization Security Logs
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/Security-Logs/operation/api.security-logs.getMany API Documentation
     *
     * @param array $params
     * string $params[event] Enum: "login" "password.set" "password.change" "email.change" "login.change" "personal_token.issued" "personal_token.revoked" "mfa.enabled" "mfa.disabled" "session.revoke" "session.revoke_all" "sso.connect" "sso.disconnect" "user.registered" "user.remove" "application.connected" "application.disconnected" "webauthn.created" "webauthn.deleted" "trusted_device.remove" "trusted_device.remove_all" "device_verification.enabled" "device_verification.disabled"<br>
     * string $params[createdAfter]<br>
     * string $params[createdBefore]<br>
     * string $params[ipAddress]<br>
     * integer $params[userId]<br>
     * integer $params[limit]<br>
     * integer $params[offset]<br>
     * @return ModelCollection
     */
    public function listOrganizationSecurityLogs(array $params = []): ModelCollection
    {
        return $this->_list('security-logs', SecurityLog::class, $params);
    }

    /**
     * Get Organization Security Log
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/Security-Logs/operation/api.security-logs.get API Documentation
     *
     * @param int $securityLogId
     * @return SecurityLog|null
     */
    public function getOrganizationSecurityLog(int $securityLogId): ?SecurityLog
    {
        $path = sprintf('security-logs/%d', $securityLogId);
        return $this->_get($path, SecurityLog::class);
    }
}
