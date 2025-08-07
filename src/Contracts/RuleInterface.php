<?php

namespace Hejunjie\SchemaValidator\Contracts;

interface RuleInterface
{
    /**
     * 验证字段值
     *
     * @param string $field 字段名（例：user.email）
     * @param mixed  $value 传入值
     * @param mixed|null $params 规则附加参数（如 min:3 中的 3）
     *
     * @throws \Hejunjie\SchemaValidator\Exceptions\ValidationException
     * @return void
     */
    public function validate(string $field, $value, $params = null): void;

    /**
     * 规则名称（用于注册）
     */
    public function getName(): string;
}