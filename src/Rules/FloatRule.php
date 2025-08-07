<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容必须为浮点数
 * @package Hejunjie\SchemaValidator\Rules
 */
class FloatRule implements RuleInterface
{
    private string $name = 'float';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
