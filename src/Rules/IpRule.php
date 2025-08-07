<?php

namespace Hejunjie\SchemaValidator\Rules;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

/**
 * 验证：内容必须是有效的 IP 地址（IPv4 或 IPv6）
 * @package Hejunjie\SchemaValidator\Rules
 */
class IpRule implements RuleInterface
{
    private string $name = 'ip';

    public function getName(): string
    {
        return $this->name;
    }

    public function validate(string $field, $value, $params = null): void
    {
        if (!filter_var($value, FILTER_VALIDATE_IP)) {
            throw new ValidationException([$field => [$this->name]]);
        }
    }
}
