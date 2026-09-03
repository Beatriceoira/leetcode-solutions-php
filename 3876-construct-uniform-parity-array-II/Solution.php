class Solution {
    function uniformArray($nums1) {
        $minOdd = PHP_INT_MAX;
        $minEven = PHP_INT_MAX;

        foreach ($nums1 as $num) {
            if (($num & 1) === 0) {
                if ($num < $minEven) {
                    $minEven = $num;
                }
            } else {
                if ($num < $minOdd) {
                    $minOdd = $num;
                }
            }
        }

        if ($minEven === PHP_INT_MAX) {
            return true;
        }

        if ($minOdd === PHP_INT_MAX) {
            return true;
        }

        return $minOdd < $minEven;
    }
}
