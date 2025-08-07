<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容必须是邮箱格式
 * @package Hejunjie\SchemaValidator\Rules
 */
class EmailRule implements RuleInterface
{
    private string $name = 'email';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
