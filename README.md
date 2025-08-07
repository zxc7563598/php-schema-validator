# hejunjie/schema-validator

<div align="center">
  <a href="./README.md">English</a>｜<a href="./README.zh-CN.md">简体中文</a>
  <hr width="50%"/>
</div>

A simple and extensible PHP parameter validation library, supporting rule-based definitions and custom extensions, suitable for any structured data verification scenarios

**This project has been parsed by Zread. If you need a quick overview of the project, you can click here to view it：[Understand this project](https://zread.ai/zxc7563598/php-schema-validator)**

---

## 📦 Installation method

Install using Composer：

```bash
composer require hejunjie/schema-validator
```

---

## 🚀 Usage

Support multiple rule definitions + throw exceptions + custom extensions：

```php
use Hejunjie\SchemaValidator\Validator;
use Hejunjie\SchemaValidator\Exceptions\ValidationException;

$data = [
    'name'   => '张三',
    'age'    => 28,
    'email'  => 'invalid-email',
];

// Custom extension. If true is returned, the rule passes; otherwise, it is considered as failing
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
    echo "Verified by ✅";
} catch (ValidationException $e) {
    echo "Validation failed ❌" . PHP_EOL;
    print_r($e->getErrors());
}

// Return the fields and rules indicating whether it is passed or failed:
// Validation failed ❌
// Array
// (
//     [email] => Array
//         (
//             [0] => email
//         )

// )
```

---

## ✅ Default support rule

The following rules are already supported in a built-in manner and are implemented as independent classes, allowing for free extension or replacement：

### Type class

| Rule Name     | Function Description                                                           | Parameter Format | Example Usage              |
| ------------- | ------------------------------------------------------------------------------ | ---------------- | -------------------------- |
| `StringRule`  | Verify whether it is a string                                                  | `string`         | `['param' => ['string']]`  |
| `IntegerRule` | Verify whether it is an integer                                                | `integer`        | `['param' => ['integer']]` |
| `BooleanRule` | Verify whether it is a boolean value (true/false or 0/1)                       | `boolean`        | `['param' => ['boolean']]` |
| `ArrayRule`   | Verify whether it is an array                                                  | `array`          | `['param' => ['array']]`   |
| `ObjectRule`  | Verify whether it is an object                                                 | `object`         | `['param' => ['object']]`  |
| `FloatRule`   | Verify whether it is a floating-point number                                   | `float`          | `['param' => ['float']]`   |
| `NumericRule` | Verify whether it is a number (including integer, floating-point string, etc.) | `numeric`        | `['param' => ['numeric']]` |

---

### Compare class

| Rule Name       | Function Description                                                                                     | Parameter Format | Example Usage                    |
| --------------- | -------------------------------------------------------------------------------------------------------- | ---------------- | -------------------------------- |
| `MinRule`       | The numerical value or string length cannot be less than the specified value                             | `min`            | `['param' => ['min:2']]`         |
| `MaxRule`       | The size of numbers or the length of strings are not allowed to exceed the specified value               | `max`            | `['param' => ['max:2']]`         |
| `BetweenRule`   | The size of a number or the length of a string must fall within the specified minimum and maximum values | `between`        | `['param' => ['between:18,60']]` |
| `LengthRule`    | The length of the string must be equal to the specified value                                            | `length`         | `['param' => ['length:10']]`     |
| `MinLengthRule` | The length of the string is not allowed to exceed the specified value                                    | `min_length`     | `['param' => ['min_length:2']]`  |
| `MaxLengthRule` | The length of the string cannot be less than the specified value                                         | `max_length`     | `['param' => ['max_length:20']]` |
| `GtRule`        | The number must be greater than the specified value                                                      | `gt`             | `['param' => ['gt:2']]`          |
| `LtRule`        | The number must be less than the specified value                                                         | `lt`             | `['param' => ['lt:2']]`          |
| `GteRule`       | The number must be greater than or equal to the specified value                                          | `gte`            | `['param' => ['gte:2']]`         |
| `LteRule`       | The number must be less than or equal to the specified value                                             | `lte`            | `['param' => ['lte:2']]`         |

---

### Format class

| Rule Name       | Function Description                                                      | Parameter Format | Example Usage                 |
| --------------- | ------------------------------------------------------------------------- | ---------------- | ----------------------------- |
| `EmailRule`     | The content must be in email format                                       | `email`          | `['param' => ['email']]`      |
| `MobileRule`    | The content must be in the format of a mainland China mobile phone number | `mobile`         | `['param' => ['mobile']]`     |
| `UrlRule`       | The content must be a URL                                                 | `url`            | `['param' => ['url']]`        |
| `IpRule`        | The content must be a valid IP address (IPv4 or IPv6)                     | `ip`             | `['param' => ['ip']]`         |
| `JsonRule`      | The content must be a valid JSON string                                   | `json`           | `['param' => ['json']]`       |
| `AlphaRule`     | The content can only contain letters                                      | `alpha`          | `['param' => ['alpha']]`      |
| `AlphaNumRule`  | The content can only contain letters and numbers                          | `alpha_num`      | `['param' => ['alpha_num']]`  |
| `AlphaDashRule` | The content can only contain letters, numbers, dashes, and underscores    | `alpha_dash`     | `['param' => ['alpha_dash']]` |

---

### Boolean class

| Rule Name      | Function Description                                 | Parameter Format | Example Usage               |
| -------------- | ---------------------------------------------------- | ---------------- | --------------------------- |
| `RequiredRule` | The content must exist and not be empty              | `required`       | `['param' => ['required']]` |
| `AcceptedRule` | The content can only be "yes", "on", "1", or "true"  | `accepted`       | `['param' => ['accepted']]` |
| `DeclinedRule` | The content can only be "no", "off", "0", or "false" | `declined`       | `['param' => ['declined']]` |

---

### Custom class

| Rule Name        | Function Description                             | Parameter Format | Example Usage                  |
| ---------------- | ------------------------------------------------ | ---------------- | ------------------------------ |
| `StartsWithRule` | The content must start with the specified string | `starts_with`    | `['param' => ['starts_with']]` |
| `EndsWithRule`   | The content must end with the specified string   | `ends_with`      | `['param' => ['ends_with']]`   |
| `ContainsRule`   | The content must contain the specified string    | `contains`       | `['param' => ['contains']]`    |

> The error message is returned as an array of rule names, and the prompt text can be customized

---

## 🧩 Purpose & Original Intent

In daily development, we often need to perform structured validation on incoming data, but many existing libraries are either bulky, rely on frameworks, or are not flexible in terms of extension (such as Laravel Validator).

The goal of this library is to:

- ✅ Zero dependencies, suitable for any PHP project
- ✅ Validation for structured arrays
- ✅ Each rule is encapsulated independently, facilitating customization and expansion
- ✅ More suitable for field prompts and error handling in the Chinese context

If you need a simple, clear, and rule-controlled data verification tool, it may be just right for you.

---

## 🙌 Welcome to contribute

Welcome to raise issues, submit pull requests, or directly fork for use!

If you have other commonly used validation rules, feel free to add them, even if it's just a line of regular expression.
