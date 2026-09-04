# 8. String to Integer (atoi)

Difficulty: Medium
Language: PHP
Link: https://leetcode.com/problems/string-to-integer-atoi/description/

## Problem

Implement `myAtoi(string $s)` to convert a string into a 32-bit signed integer.

The conversion follows these rules:

1. Ignore leading spaces.
2. Check for an optional `+` or `-` sign.
3. Read consecutive digits.
4. Stop at the first non-digit character.
5. Clamp the result to the 32-bit signed integer range:

   * Minimum: `-2147483648`
   * Maximum: `2147483647`

## Approach

Use a single-pass parsing algorithm.

The string is processed from left to right:

```text
"   -0042abc"
     ↓
  skip spaces
     ↓
   read '-'
     ↓
  read "0042"
     ↓
 stop at 'a'
     ↓
   return -42
```

The number is constructed digit-by-digit:

```text
num = num × 10 + digit
```

Before adding each digit, an overflow check is performed to ensure the result stays within the 32-bit signed integer range.

## Algorithm

1. Initialize the string index and length.
2. Skip all leading spaces.
3. Determine the sign.
4. Iterate through consecutive numeric characters.
5. Convert each character to its numeric value using ASCII:

   ```php
   $digit = ord($s[$i]) - 48;
   ```
6. Check whether adding the digit would cause overflow.
7. Update the number:

   ```php
   $num = $num * 10 + $digit;
   ```
8. Return the signed result.

## Overflow Handling

The maximum positive 32-bit integer is:

```text
2147483647
```

Before calculating:

```text
num × 10 + digit
```

we check whether:

```text
num > 214748364
```

or:

```text
num == 214748364 AND digit > 7
```

If overflow would occur:

```php
return $sign > 0 ? 2147483647 : -2147483648;
```

This prevents the number from exceeding the required 32-bit range.

## Examples

### Example 1

```text
Input:  "42"
Output: 42
```

### Example 2

```text
Input:  " -042"
Output: -42
```

### Example 3

```text
Input:  "1337c0d3"
Output: 1337
```

The conversion stops when `c` is encountered.

### Example 4

```text
Input:  "0-1"
Output: 0
```

The conversion stops after reading `0`.

### Example 5

```text
Input:  "words and 987"
Output: 0
```

The first character is not a digit or sign, so no number is read.

## Complexity

Let `n` be the length of the input string.

* Time: `O(n)`
* Space: `O(1)`

Each character is processed at most once, and only a constant number of variables are used.

## Key Takeaways

* Single-pass parsing is sufficient.
* Multi-character numbers can be built with `num × 10 + digit`.
* Check for overflow before performing the multiplication.
* Stop immediately when a non-digit is encountered.
* No arrays, regular expressions, or additional strings are required.
* `O(n)` time and `O(1)` space are optimal for this problem.
