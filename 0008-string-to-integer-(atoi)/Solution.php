class Solution
{
    function myAtoi($s)
    {
        $i = 0;
        $n = strlen($s);

        while ($i < $n && $s[$i] === ' ') {
            ++$i;
        }

        $sign = 1;

        if ($i < $n) {
            if ($s[$i] === '-') {
                $sign = -1;
                ++$i;
            } elseif ($s[$i] === '+') {
                ++$i;
            }
        }

        $num = 0;

        while ($i < $n) {
            $c = ord($s[$i]);

            if ($c < 48 || $c > 57) {
                break;
            }

            $digit = $c - 48;

            if ($num > 214748364 || ($num === 214748364 && $digit > 7)) {
                return $sign > 0 ? 2147483647 : -2147483648;
            }

            $num = $num * 10 + $digit;
            ++$i;
        }

        return $num * $sign;
    }
}