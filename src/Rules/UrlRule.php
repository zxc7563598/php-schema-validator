<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容必须是URL
 * @package Hejunjie\SchemaValidator\Rules
 */
class UrlRule implements RuleInterface
{
    private string $name = 'url';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!is_string($value) && !is_numeric($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
