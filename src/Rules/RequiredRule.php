<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Helpers;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容必须存在且不为空
 * @package Hejunjie\SchemaValidator\Rules
 */
class RequiredRule implements RuleInterface
{
    private string $name = 'required';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if ($this->isEmpty($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }

    /**
     * 判断值是否为空（null、空字符串、空数组都算空）
     */
    private function isEmpty($value): bool
    {
        return $value === null || $value === '' || (is_array($value) && count($value) === 0);
    }
}
