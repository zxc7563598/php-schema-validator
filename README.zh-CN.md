# hejunjie/schema-validator

<div align="center">
  <a href="./README.md">English</a>｜<a href="./README.zh-CN.md">简体中文</a>
  <hr width="50%"/>
</div>

一个简单且可扩展的 PHP 参数验证库，支持规则式定义与自定义扩展，适用于任何结构化数据校验场景

**本项目已经经由 Zread 解析完成，如果需要快速了解项目，可以点击此处进行查看：[了解本项目](https://zread.ai/zxc7563598/php-schema-validator)**

---

## 📦 安装方式

使用 Composer 安装：

```bash
composer require hejunjie/schema-validator
```

---

## 🚀 使用方式

支持多规则定义 + 抛出异常 + 自定义扩展：

```php
use Hejunjie\SchemaValidator\Validator;
use Hejunjie\SchemaValidator\Exceptions\ValidationException;

$data = [
    'name'   => '张三',
    'age'    => 28,
    'email'  => 'invalid-email',
];

// 自定义扩展，返回 true 则规则通过，否则均视为不通过
Validator::extend('is_zh', function ($field, $value, $params = null) {
    if (preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $value)) {
        return true;
    }
});

try {
    Validator::validate($data, [
        'name'  => ['is_zh', 'string', 'minLength:2'],
        'age'   => ['integer', 'between:18,60'],
        'email' => ['required', 'email'],
    ]);
    echo "验证通过 ✅";
} catch (ValidationException $e) {
    echo "验证失败 ❌" . PHP_EOL;
    print_r($e->getErrors());
}

// 返回是否通过以及不通过的字段与规则：
// 验证失败 ❌
// Array
// (
//     [email] => Array
//         (
//             [0] => email
//         )

// )
```

---

## ✅ 默认支持规则

以下规则已内置支持，均以独立类形式实现，可自由扩展或替换：

### 类型类

| 规则名        | 功能描述                                   | 参数格式  | 示例用法                   |
| ------------- | ------------------------------------------ | --------- | -------------------------- |
| `StringRule`  | 验证是否为字符串                           | `string`  | `['param' => ['string']]`  |
| `IntegerRule` | 验证是否为整数                             | `integer` | `['param' => ['integer']]` |
| `BooleanRule` | 验证是否为布尔值（true/false 或 0/1）      | `boolean` | `['param' => ['boolean']]` |
| `ArrayRule`   | 验证是否为数组                             | `array`   | `['param' => ['array']]`   |
| `ObjectRule`  | 验证是否为对象                             | `object`  | `['param' => ['object']]`  |
| `FloatRule`   | 验证是否为浮点数                           | `float`   | `['param' => ['float']]`   |
| `NumericRule` | 验证是否为数字（包括整型、浮点型字符串等） | `numeric` | `['param' => ['numeric']]` |

---

### 比较类

| 规则名          | 功能描述                                           | 参数格式     | 示例用法                         |
| --------------- | -------------------------------------------------- | ------------ | -------------------------------- |
| `MinRule`       | 数值大小或字符串长度不允许小于指定值               | `min`        | `['param' => ['min:2']]`         |
| `MaxRule`       | 数字大小或字符串长度不允许超过指定值               | `max`        | `['param' => ['max:2']]`         |
| `BetweenRule`   | 数字大小或字符串长度必须在指定的最小值和最大值之间 | `between`    | `['param' => ['between:18,60']]` |
| `LengthRule`    | 字符串长度必须等于指定值                           | `length`     | `['param' => ['length:10']]`     |
| `MinLengthRule` | 字符串的长度不允许超过指定值                       | `min_length` | `['param' => ['min_length:2']]`  |
| `MaxLengthRule` | 字符串的长度不允许小于指定值                       | `max_length` | `['param' => ['max_length:20']]` |
| `GtRule`        | 数字必须大于指定值                                 | `gt`         | `['param' => ['gt:2']]`          |
| `LtRule`        | 数字必须小于指定值                                 | `lt`         | `['param' => ['lt:2']]`          |
| `GteRule`       | 数字必须大于或等于指定值                           | `gte`        | `['param' => ['gte:2']]`         |
| `LteRule`       | 数字必须小于或等于指定值                           | `lte`        | `['param' => ['lte:2']]`         |

---

### 格式类

| 规则名          | 功能描述                                 | 参数格式     | 示例用法                      |
| --------------- | ---------------------------------------- | ------------ | ----------------------------- |
| `EmailRule`     | 内容必须是邮箱格式                       | `email`      | `['param' => ['email']]`      |
| `MobileRule`    | 内容必须是中国大陆手机号格式             | `mobile`     | `['param' => ['mobile']]`     |
| `UrlRule`       | 内容必须是 URL                           | `url`        | `['param' => ['url']]`        |
| `IpRule`        | 内容必须是有效的 IP 地址（IPv4 或 IPv6） | `ip`         | `['param' => ['ip']]`         |
| `JsonRule`      | 内容必须是有效的 Json 字符串             | `json`       | `['param' => ['json']]`       |
| `AlphaRule`     | 内容只能包含字母                         | `alpha`      | `['param' => ['alpha']]`      |
| `AlphaNumRule`  | 内容只能包含字母和数字                   | `alpha_num`  | `['param' => ['alpha_num']]`  |
| `AlphaDashRule` | 内容只能包含字母、数字、破折号、下划线   | `alpha_dash` | `['param' => ['alpha_dash']]` |

---

### 布尔类

| 规则名         | 功能描述                     | 参数格式   | 示例用法                    |
| -------------- | ---------------------------- | ---------- | --------------------------- |
| `RequiredRule` | 内容必须存在且不为空         | `required` | `['param' => ['required']]` |
| `AcceptedRule` | 内容只能为 yes、on、1、true  | `accepted` | `['param' => ['accepted']]` |
| `DeclinedRule` | 内容只能为 no、off、0、false | `declined` | `['param' => ['declined']]` |

---

### 自定义类

| 规则名           | 功能描述                 | 参数格式      | 示例用法                       |
| ---------------- | ------------------------ | ------------- | ------------------------------ |
| `StartsWithRule` | 内容必须以指定字符串开头 | `starts_with` | `['param' => ['starts_with']]` |
| `EndsWithRule`   | 内容必须以指定字符串结尾 | `ends_with`   | `['param' => ['ends_with']]`   |
| `ContainsRule`   | 内容必须包含指定字符串   | `contains`    | `['param' => ['contains']]`    |

> 错误信息返回为规则名数组，可自行定义提示文案。

---

## 🧩 用途 & 初衷

在日常开发中，我们常常需要对传入的数据进行结构化验证，但很多现有的库要么体积庞大、依赖框架，要么扩展不灵活（比如 Laravel Validator ）。

这个库的目标是：

- ✅ 零依赖，适用于任何 PHP 项目
- ✅ 面向结构化数组进行验证
- ✅ 每条规则独立封装，方便自定义与扩展
- ✅ 更适合中文语境下的字段提示与错误处理

如果你需要一个简单清晰、规则可控的数据验证工具，它可能正好适合你。

---

## 🙌 欢迎贡献

欢迎提出 Issue、提交 PR 或直接 Fork 使用！

如果你有其他常用验证规则，也欢迎补充，哪怕是一行正则。
