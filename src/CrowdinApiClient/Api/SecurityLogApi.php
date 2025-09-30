<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\SecurityLog;
use CrowdinApiClient\ModelCollection;

/**
 * Security Logs API gives you the possibility to get information about user security activities.
 *
 * @package Crowdin\Api
 */
class SecurityLogApi extends AbstractApi
{
    /**
     * List User Security Logs
     * @link https://support.crowdin.com/developer/api/v2/#tag/Security-Logs/operation/api.users.security-logs.getMany API Documentation
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/Security-Logs/operation/api.users.security-logs.getMany API Documentation Enterprise
     *
     * @param int $userId
     * @param array $params
     * string $params[event] Enum: "login" "password.set" "password.change" "email.change" "login.change" "personal_token.issued" "personal_token.revoked" "mfa.enabled" "mfa.disabled" "session.revoke" "session.revoke_all" "sso.connect" "sso.disconnect" "user.registered" "user.remove" "application.connected" "application.disconnected" "webauthn.created" "webauthn.deleted" "trusted_device.remove" "trusted_device.remove_all" "device_verification.enabled" "device_verification.disabled"<br>
     * string $params[createdAfter]<br>
     * string $params[createdBefore]<br>
     * string $params[ipAddress]<br>
     * integer $params[limit]<br>
     * integer $params[offset]<br>
     * @return ModelCollection
     */
    public function listUserSecurityLogs(int $userId, array $params = []): ModelCollection
    {
        $path = sprintf('users/%d/security-logs', $userId);
        return $this->_list($path, SecurityLog::class, $params);
    }

    /**
     * Get User Security Log
     * @link https://support.crowdin.com/developer/api/v2/#tag/Security-Logs/operation/api.users.security-logs.get API Documentation
     * @link https://support.crowdin.com/developer/enterprise/api/v2/#tag/Security-Logs/operation/api.users.security-logs.get API Documentation Enterprise
     *
     * @param int $userId
     * @param int $securityLogId
     * @return SecurityLog|null
     */
    public function getUserSecurityLog(int $userId, int $securityLogId): ?SecurityLog
    {
        $path = sprintf('users/%d/security-logs/%d', $userId, $securityLogId);
        return $this->_get($path, SecurityLog::class);
    }
}
