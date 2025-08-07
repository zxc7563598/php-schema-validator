<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容只能为 no、off、0、false
 * @package Hejunjie\SchemaValidator\Rules
 */
class DeclinedRule implements RuleInterface
{
    private string $name = 'declined';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        $validFalseValues = ['no', 'off', '0', 'false', ''];
        if (!in_array(strtolower($value), $validFalseValues, true)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
