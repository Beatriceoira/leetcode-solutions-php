# 3876. Construct Uniform Parity Array II

Difficulty: Medium
Language: PHP
Link: https://leetcode.com/problems/construct-uniform-parity-array-ii/

## Problem

You are given an array `nums1` containing `n` distinct positive integers.

You need to construct another array `nums2` of the same length such that all elements in `nums2` have the same parity — either all odd or all even.

For each index `i`, you may choose exactly one of:

- `nums2[i] = nums1[i]`
- `nums2[i] = nums1[i] - nums1[j]`, where `j != i` and `nums1[i] - nums1[j] >= 1`

Return `true` if such an array can be constructed; otherwise, return `false`.

## Approach

The important property is the parity of subtraction:

```text
Even - Even = Even
Odd  - Odd  = Even
Even - Odd  = Odd
Odd  - Even = Odd
```

We only need to consider the smallest odd number and the smallest even number.

### Case 1: All numbers are already even

If there are no odd numbers, the array is already uniform.

```text
[2, 4, 8] → true
```

### Case 2: All numbers are already odd

If there are no even numbers, the array is also already uniform.

```text
[1, 3, 7] → true
```

### Case 3: The array contains both odd and even numbers

The odd numbers can remain unchanged.

For every even number, we need to subtract an odd number smaller than it:

```text
Even - Odd = Odd
```

Therefore, the **smallest odd number must be smaller than the smallest even number**.

For example:

```text
[3, 6, 10]

3 < 6

6 - 3 = 3
10 - 3 = 7

Result: [3, 3, 7]
```

All elements are odd, so the answer is `true`.

However:

```text
[2, 3, 7]

smallest odd = 3
smallest even = 2

3 > 2
```

The `2` cannot subtract a positive smaller odd number, so the answer is `false`.

## Algorithm

1. Find the smallest odd number.
2. Find the smallest even number.
3. If there are no odd numbers, return `true`.
4. If there are no even numbers, return `true`.
5. Otherwise, return whether:

```text
minimum odd < minimum even
```

## PHP Implementation

```php
class Solution {
    function uniformArray($nums1) {
        $minOdd = PHP_INT_MAX;
        $minEven = PHP_INT_MAX;

        foreach ($nums1 as $num) {
            if ($num & 1) {
                $minOdd = min($minOdd, $num);
            } else {
                $minEven = min($minEven, $num);
            }
        }

        // Already all odd
        if ($minEven === PHP_INT_MAX) {
            return true;
        }

        // Already all even
        if ($minOdd === PHP_INT_MAX) {
            return true;
        }

        // Every even number needs a smaller odd number
        // to subtract from it.
        return $minOdd < $minEven;
    }
}
```

## Example

### Input

```text
nums1 = [1, 4, 7]
```

Smallest odd:

```text
1
```

Smallest even:

```text
4
```

Since:

```text
1 < 4
```

we can subtract `1` from the even number:

```text
4 - 1 = 3
```

Giving:

```text
[1, 3, 7]
```

All elements are odd.

### Output

```text
true
```

## Edge Cases

### Single element

```text
[3] → true
[4] → true
```

A single-element array is already uniform.

### All odd

```text
[1, 5, 9] → true
```

No changes are required.

### All even

```text
[2, 6, 10] → true
```

No changes are required.

### Mixed parity with a smaller odd

```text
[3, 8, 12] → true
```

Because:

```text
3 < 8
3 < 12
```

Both even values can be converted to odd values.

### Mixed parity without a smaller odd

```text
[2, 3, 9] → false
```

The even number `2` has no smaller positive odd number to subtract.

## Complexity

- Time: `O(n)` — the array is traversed once.
- Space: `O(1)` — only two variables are used.

 Key Insight

> If both parities exist, the array can be made uniformly odd if and only if the smallest odd number is smaller than the smallest even number.

Otherwise, if the array already contains only odd or only even numbers, the answer is automatically `true`.
