<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：数字必须大于指定值
 * @package Hejunjie\SchemaValidator\Rules
 */
class GtRule implements RuleInterface
{
    private string $name = 'gt';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!is_numeric($params)) {
            throw new \InvalidArgumentException("gt 参数格式错误，必须是数字");
        }
        if (!is_numeric($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
        if ($value <= $params) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
