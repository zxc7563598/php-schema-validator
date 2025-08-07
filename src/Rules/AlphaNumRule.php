<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容只能包含字母和数字
 * @package Hejunjie\SchemaValidator\Rules
 */
class AlphaNumRule implements RuleInterface
{
    private string $name = 'alpha_num';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!preg_match('/^[a-zA-Z0-9]+$/', $value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
