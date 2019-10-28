<?php


namespace Crowdin\Exceptions;

use Throwable;

/**
 * Class ApiValidationException
 * @package Crowdin\Exceptions
 */
class ApiValidationException extends CrowdinException
{
    /**
     * ApiValidationException constructor.
     * @param string $message
     * @param array $errors
     *
     */
    public function __construct($message = "", $errors = [])
    {
        $this->errors = $errors;
        parent::__construct($message);
    }

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
