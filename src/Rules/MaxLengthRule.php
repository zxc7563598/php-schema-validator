<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：字符串的长度不允许超过指定值
 * @package Hejunjie\SchemaValidator\Rules
 */
class MaxLengthRule implements RuleInterface
{
    private string $name = 'max_length';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!is_numeric($params) || (int)$params != $params || $params < 0) {
            throw new \InvalidArgumentException("max_length 参数格式错误，必须是非负整数");
        }
        if (!is_string($value) && !is_numeric($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
        $length = (int)$params;
        if (mb_strlen($value) > $length) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
