<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容必须为字符串
 * @package Hejunjie\SchemaValidator\Rules
 */
class StringRule implements RuleInterface
{
    private string $name = 'string';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!is_string($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
