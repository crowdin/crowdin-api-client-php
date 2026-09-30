<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\OrganizationAuthSettings;
use PHPUnit\Framework\TestCase;

class OrganizationAuthSettingsTest extends TestCase
{
    public function testLoadData(): void
    {
        $settings = new OrganizationAuthSettings([
            'allowSignUp' => true,
            'twoFactorAuthentication' => false,
            'authMethods' => [['name' => 'saml', 'isEnabled' => true, 'isDefault' => true]],
        ]);

        $this->assertTrue($settings->getAllowSignUp());
        $this->assertFalse($settings->getTwoFactorAuthentication());
        $this->assertSame([['name' => 'saml', 'isEnabled' => true, 'isDefault' => true]], $settings->getAuthMethods());
    }
}
