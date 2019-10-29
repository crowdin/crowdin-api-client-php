<?php


namespace Crowdin\Exceptions;

use Throwable;

/**
 * Class ApiValidationException
 * @package Crowdin\Exceptions
 */
class ApiValidationException extends CrowdinException
{
    public $errors = [];

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

}
