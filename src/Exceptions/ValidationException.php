<?php

namespace Hejunjie\SchemaValidator\Exceptions;

use Exception;

class ValidationException extends \Exception
{
    protected array $errors;

    public function __construct(array $errors)
    {
        parent::__construct("Validation failed");
        $this->errors = $errors;
    }

    /**
     * 获取所有验证错误
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
