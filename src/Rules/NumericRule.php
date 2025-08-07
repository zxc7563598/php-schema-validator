<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容必须为数字（包含整数、小数、科学计数法等）
 * @package Hejunjie\SchemaValidator\Rules
 */
class NumericRule implements RuleInterface
{
    private string $name = 'numeric';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!is_numeric($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
