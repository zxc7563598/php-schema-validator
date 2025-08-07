<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容必须为整数
 * @package Hejunjie\SchemaValidator\Rules
 */
class IntegerRule implements RuleInterface
{
    private string $name = 'integer';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!filter_var($value, FILTER_VALIDATE_INT)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
