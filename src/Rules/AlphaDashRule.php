<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容只能包含字母、数字、破折号、下划线
 * @package Hejunjie\SchemaValidator\Rules
 */
class AlphaDashRule implements RuleInterface
{
    private string $name = 'alpha_dash';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
