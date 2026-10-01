<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

class OrganizationAuthSettings extends BaseModel
{
    /** @var bool */
    protected $allowSignUp;

    /** @var bool */
    protected $twoFactorAuthentication;

    /** @var array */
    protected $authMethods;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->allowSignUp = (bool)$this->getDataProperty('allowSignUp');
        $this->twoFactorAuthentication = (bool)$this->getDataProperty('twoFactorAuthentication');
        $this->authMethods = (array)$this->getDataProperty('authMethods');
    }

    public function getAllowSignUp(): bool
    {
        return $this->allowSignUp;
    }

    public function getTwoFactorAuthentication(): bool
    {
        return $this->twoFactorAuthentication;
    }

    /**
     * @return array list of name, isEnabled, isDefault
     */
    public function getAuthMethods(): array
    {
        return $this->authMethods;
    }
}
