<?php

namespace Hejunjie\SchemaValidator;

use Hejunjie\SchemaValidator\Exceptions\ValidationException;
use Hejunjie\SchemaValidator\Contracts\RuleInterface;

class Validator
{
    protected static array $customRules = []; // 自定义规则

    /**
     * 验证数据是否符合给定的 schema
     * 
     * @param array $data 需要验证的数据
     * @param array $schema 验证规则，格式为 ['field' => 'rule1|rule2', ...]
     * 
     * @return void
     * @throws \InvalidArgumentException
     * @throws ValidationException 
     */
    public static function validate(array $data, array $schema): void
    {
        $errors = [];
        foreach ($schema as $field => $rules) {
            $rules = is_array($rules) ? $rules : explode('|', $rules);
            $value = Helpers::getValue($data, $field);
            foreach ($rules as $rule) {
                [$name, $params] = array_pad(explode(':', $rule, 2), 2, null);
                $validator = self::resolveRule($name);
                try {
                    $validator->validate($field, $value, $params);
                } catch (ValidationException $e) {
                    $error = $e->getErrors();
                    if (isset($errors[$field])) {
                        $errors[$field] = array_merge($errors[$field], $error[$field] ?? []);
                    } else {
                        $errors[$field] = $error[$field] ?? [];
                    }
                }
            }
        }
        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }

    /**
     * 注册自定义规则
     * 
     * @param string $name field 字段名
     * @param callable $callback 回调函数，接收参数 (string $field, mixed $value, mixed $params)，返回 bool
     * 
     * @return void 
     */
    public static function extend(string $name, callable $callback): void
    {
        self::$customRules[$name] = $callback;
    }

    /**
     * 解析规则名称，返回对应的 Rule 实例
     * 
     * @param string $name Rule 名称
     * 
     * @return RuleInterface 
     * @throws \InvalidArgumentException 
     */
    protected static function resolveRule(string $name): RuleInterface
    {
        // 优先使用自定义规则
        if (isset(self::$customRules[$name])) {
            return new class($name, self::$customRules[$name]) implements RuleInterface {
                private $name;
                private $callback;
                public function __construct($name, $callback)
                {
                    $this->name = $name;
                    $this->callback = $callback;
                }
                public function validate(string $field, $value, $params = null): void
                {
                    $result = call_user_func($this->callback, $field, $value, $params);
                    if ($result !== true) {
                        throw new \Hejunjie\SchemaValidator\Exceptions\ValidationException([
                            $field => [$this->name]
                        ]);
                    }
                }
                public function getName(): string
                {
                    return $this->name;
                }
            };
        }
        // 默认规则类
        $class = __NAMESPACE__ . '\\Rules\\' . Helpers::studly_case($name) . 'Rule';
        if (!class_exists($class)) {
            throw new \InvalidArgumentException("Rule [{$name}] not found.");
        }
        return new $class();
    }
}
