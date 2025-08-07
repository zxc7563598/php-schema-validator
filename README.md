



### 🟦 类型类

- ​`StringRule`：内容必须为字符串
- ​`IntegerRule`：内容必须为整数
- ​`BooleanRule`：内容必须为布尔值 true/false
- ​`ArrayRule`：内容必须为数组
- ​`ObjectRule`：内容必须为对象
- ​`FloatRule`：内容必须为浮点数
- ​`NumericRule`：内容必须为数字（包含整数、小数、科学计数法等）

---

### 🟩 比较类

- ​`MinRule`：数值大小或字符串长度不允许小于指定值
- ​`MaxRule`：数字大小或字符串长度不允许超过指定值
- ​`BetweenRule`：数字大小或字符串长度必须在指定的最小值和最大值之间
- ​`LengthRule`：字符串长度必须等于指定值
- ​`MinLengthRule`：字符串的长度不允许小于指定值
- ​`MaxLengthRule`：字符串的长度不允许超过指定值
- ​`GtRule`：数字必须大于指定值
- ​`LtRule`：数字必须小于指定值
- ​`GteRule`：数字必须大于或等于指定值
- ​`LteRule`：数字必须小于或等于指定值

---

### 🟨 格式类

- ​`EmailRule`：内容必须是邮箱格式
- ​`MobileRule`：内容必须是中国大陆手机号格式
- ​`UrlRule`：内容必须是URL
- ​`IpRule`：内容必须是有效的 IP 地址（IPv4 或 IPv6）
- ​`JsonRule`：内容必须是有效的Json字符串
- ​`AlphaRule`：内容只能包含字母
- ​`AlphaNumRule`：内容只能包含字母和数字
- ​`AlphaDashRule`：内容只能包含字母、数字、破折号、下划线

---

### 🟥 布尔类

- ​`RequiredRule`：内容必须存在且不为空
- ​`AcceptedRule`：内容只能为 yes、on、1、true
- ​`DeclinedRule`：内容只能为 no、off、0、false

---

### 🟪 自定义类

- ​`StartsWithRule`：内容必须以指定字符串开头
- ​`EndsWithRule`：内容必须以指定字符串结尾
- ​`ContainsRule`：内容必须包含指定字符串
