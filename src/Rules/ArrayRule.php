<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容必须为数组
 * @package Hejunjie\SchemaValidator\Rules
 */
class ArrayRule implements RuleInterface
{
    private string $name = 'array';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!is_array($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
