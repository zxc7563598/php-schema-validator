<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：数值大小或字符串长度不允许小于指定值
 * @package Hejunjie\SchemaValidator\Rules
 */
class MinRule implements RuleInterface
{
    private string $name = 'min';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!is_numeric($params)) {
            throw new \InvalidArgumentException("max 参数格式错误，必须是数字");
        }
        if (!is_string($value) && !is_numeric($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
        $value = trim((string)$value);
        if (is_numeric($value)) {
            if ($value > $params) {
                throw new ValidationException([$field => [$this->name]]);
            }
        } else {
            $length = mb_strlen($value);
            if ($length < $params) {
                throw new ValidationException([$field => [$this->name]]);
            }
        }
    }
}
