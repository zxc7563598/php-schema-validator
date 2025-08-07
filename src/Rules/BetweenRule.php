<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;
use Hejunjie\SchemaValidator\Helpers;

/**
 * 验证：数字大小或字符串长度必须在指定的最小值和最大值之间
 * @package Hejunjie\SchemaValidator\Rules
 */
class BetweenRule implements RuleInterface
{
    private string $name = 'between';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!is_string($value) && !is_numeric($value)) {
            throw new ValidationException([$field => [$this->name]]);
        }
        list($min, $max) = $this->parseBetweenParams($params);
        $value = trim((string)$value);
        if (is_numeric($value)) {
            if ($value < $min || $value > $max) {
                throw new ValidationException([$field => [$this->name]]);
            }
        } else {
            $length = mb_strlen($value);
            if ($length < $min || $length > $max) {
                throw new ValidationException([$field => [$this->name]]);
            }
        }
    }

    private function parseBetweenParams(string $params): array
    {
        if (preg_match('/^(-?\d+(?:\.\d+)?)-(-?\d+(?:\.\d+)?)$/', $params, $matches)) {
            return [(float)$matches[1], (float)$matches[2]];
        }
        throw new \InvalidArgumentException("between 参数格式错误，必须是 'min-max'，例如：'-10--1' 或 '0.5-5.5'");
    }
}
