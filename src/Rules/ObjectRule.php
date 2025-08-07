<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容必须为对象
 * @package Hejunjie\SchemaValidator\Rules
 */
class ObjectRule implements RuleInterface
{
    private string $name = 'object';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!is_object($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
