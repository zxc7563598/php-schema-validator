<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容必须为布尔值 true/false
 * @package Hejunjie\SchemaValidator\Rules
 */
class BooleanRule implements RuleInterface
{
    private string $name = 'boolean';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!is_bool($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
