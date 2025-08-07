<?php

namespace Hejunjie\SchemaValidator;

class Helpers
{
    /**
     * 从数组中获取字段值（支持点语法，如 user.email）
     */
    public static function getValue(array $data, string $field)
    {
        if (strpos($field, '.') === false) {
            return $data[$field] ?? null;
        }

        $segments = explode('.', $field);
        foreach ($segments as $segment) {
            if (!is_array($data) || !array_key_exists($segment, $data)) {
                return null;
            }
            $data = $data[$segment];
        }
        return $data;
    }

    /**
     * 将字符串转换为驼峰命名法（如 "user_name" 转为 "UserName"）
     */
    public static function studly_case(string $string): string
    {
        return str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $string)));
    }
}
