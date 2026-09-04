class Solution
{
    function orangesRotting($grid)
    {
        $rows = count($grid);
        $cols = count($grid[0]);

        $queue = [];
        $fresh = 0;
        for ($r = 0; $r < $rows; $r++) {
            for ($c = 0; $c < $cols; $c++) {
                if ($grid[$r][$c] === 2) {
                    $queue[] = [$r, $c];
                } elseif ($grid[$r][$c] === 1) {
                    $fresh++;
                }
            }
        }
        if ($fresh === 0) {
            return 0;
        }

        $minutes = 0;
        $directions = [
            [-1, 0], 
            [1, 0],  
            [0, -1], 
            [0, 1]   
        ];

        $head = 0;
        while ($head < count($queue) && $fresh > 0) {
            $levelSize = count($queue) - $head;

            for ($i = 0; $i < $levelSize; $i++) {
                [$r, $c] = $queue[$head++];

                foreach ($directions as [$dr, $dc]) {
                    $nr = $r + $dr;
                    $nc = $c + $dc;
                    if (
                        $nr >= 0 && $nr < $rows &&
                        $nc >= 0 && $nc < $cols &&
                        $grid[$nr][$nc] === 1
                    ) {
                        $grid[$nr][$nc] = 2;
                        $fresh--;

                        $queue[] = [$nr, $nc];
                    }
                }
            }

            $minutes++;
        }
        return $fresh === 0 ? $minutes : -1;
    }
}