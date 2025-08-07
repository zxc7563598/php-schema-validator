<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容必须是有效的Json字符串
 * @package Hejunjie\SchemaValidator\Rules
 */
class JsonRule implements RuleInterface
{
    private string $name = 'json';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!is_string($value) && !is_numeric($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
        if (!$this->isValidJson($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }

    private function isValidJson(string $string): bool
    {
        $decoded = json_decode($string, true);
        return json_last_error() === JSON_ERROR_NONE && is_array($decoded);
    }
}
