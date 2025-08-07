<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容必须是中国大陆手机号格式
 * @package Hejunjie\SchemaValidator\Rules
 */
class MobileRule implements RuleInterface
{
    private string $name = 'mobile';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!is_string($value) && !is_numeric($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
        if (!preg_match('/^1[3-9]\d{9}$/', $value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
