<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容只能为 yes、on、1、true
 * @package Hejunjie\SchemaValidator\Rules
 */
class AcceptedRule implements RuleInterface
{
    private string $name = 'accepted';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        $validValues = ['yes', 'on', '1', 'true'];
        if (!in_array(strtolower($value), $validValues, true)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
