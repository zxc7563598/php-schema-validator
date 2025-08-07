<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容必须包含指定字符串
 * @package Hejunjie\SchemaValidator\Rules
 */
class ContainsRule implements RuleInterface
{
    private string $name = 'contains';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!is_string($params) && !is_numeric($params)) {
            throw new \InvalidArgumentException("contains 参数格式错误，必须是字符串");
        }
        if (!is_string($value) && !is_numeric($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
        if (!str_contains($value, $params)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
