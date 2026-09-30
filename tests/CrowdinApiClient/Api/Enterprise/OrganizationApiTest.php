<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\Organization;
use CrowdinApiClient\Model\Enterprise\OrganizationAuthSettings;

class OrganizationApiTest extends AbstractTestApi
{
    public function testGet(): void
    {
        $this->mockRequestGet(
            '/organization',
            json_encode([
                'data' => [
                    'id' => 200000999,
                    'domain' => 'acme',
                    'name' => 'Acme',
                    'logo' => null,
                    'defaultLogo' => 'https://crowdin.com/logo.png',
                    'description' => null,
                    'internalDescription' => null,
                    'cname' => null,
                    'isVendor' => false,
                    'defaultPublicProjectsView' => 'grid',
                    'plan' => ['name' => 'Business', 'wordsLimit' => null, 'managersLimit' => 10],
                    'defaults' => [],
                ],
            ])
        );

        $organization = $this->crowdin->organization->get();

        $this->assertInstanceOf(Organization::class, $organization);
        $this->assertEquals('acme', $organization->getDomain());
        $this->assertFalse($organization->isVendor());
    }

    public function testGetAuthSettings(): void
    {
        $this->mockRequestGet(
            '/organization/auth-settings',
            json_encode([
                'data' => [
                    'allowSignUp' => false,
                    'twoFactorAuthentication' => true,
                    'authMethods' => [['name' => 'saml', 'isEnabled' => true, 'isDefault' => true]],
                ],
            ])
        );

        $settings = $this->crowdin->organization->getAuthSettings();

        $this->assertInstanceOf(OrganizationAuthSettings::class, $settings);
        $this->assertTrue($settings->getTwoFactorAuthentication());
        $this->assertEquals('saml', $settings->getAuthMethods()[0]['name']);
    }
}
