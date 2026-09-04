#  994. Rotting Oranges

Difficulty: Medium
Topics: Array, Breadth-First Search (BFS), Matrix
Link: https://leetcode.com/problems/rotting-oranges/


## Problem

You are given an `m x n` grid where each cell contains one of three values:

- `0` — Empty cell
- `1` — Fresh orange
- `2` — Rotten orange

Every minute, a rotten orange causes any adjacent fresh orange to become rotten.

An orange is considered adjacent if it is directly up, down, left, or right of the rotten orange.

Return the minimum number of minutes that must elapse until no fresh oranges remain.

If it is impossible for all fresh oranges to become rotten, return `-1`.



## Approach

The problem is naturally modeled as a multi-source Breadth-First Search (BFS).

Instead of starting BFS from one rotten orange, we start from all rotten oranges simultaneously.

### 1. Find the initial oranges

Traverse the entire grid and:

* Add every rotten orange (`2`) to the queue.
* Count every fresh orange (`1`).

```php
if ($grid[$r][$c] === 2) {
    $queue[] = [$r, $c];
} elseif ($grid[$r][$c] === 1) {
    $fresh++;
}
```

### 2. Process the grid using BFS

Each BFS level represents one minute.

For every rotten orange currently in the queue, check its four neighboring cells.

If a neighbor contains a fresh orange:

1. Make it rotten.
2. Decrease the fresh-orange count.
3. Add it to the queue.

```php
$grid[$nr][$nc] = 2;
$fresh--;
$queue[] = [$nr, $nc];
```

### 3. Track time

After processing one complete BFS level:

```php
$minutes++;
```

This works because all oranges that rot during the same level do so during the same minute.

### 4. Check whether all oranges rotted

After BFS:

```php
return $fresh === 0 ? $minutes : -1;
```

If fresh oranges remain, they were unreachable from every rotten orange.


##  Example

### Input

```text
[[2,1,1],
 [1,1,0],
 [0,1,1]]
```

### Process

```text
Minute 0:

2 1 1
1 1 0
0 1 1
```

The initial rotten orange spreads to its neighbors:

```text
Minute 1:

2 2 1
2 1 0
0 1 1
```

Continue spreading:

```text
Minute 2:

2 2 2
2 2 0
0 1 1
```

Eventually:

```text
Minute 4:

2 2 2
2 2 0
0 2 2
```

All fresh oranges are now rotten.

Output:

```text
4
```



## ⚠️ Important Edge Cases

### No fresh oranges

```text
[[0,2]]
```

There is nothing to rot.

Answer:

```text
0
```

### Fresh oranges cannot be reached

```text
[[2,1,0,1]]
```

The last fresh orange can never become rotten.

Answer:

```text
-1
```

### Multiple rotten oranges

```text
[[2,1,1],
 [0,1,2],
 [1,1,1]]
```

All initial rotten oranges must be placed into the queue before BFS begins.

This is what makes the algorithm multi-source BFS.



##  Complexity

Let `m` be the number of rows and `n` be the number of columns.

### Time Complexity

O(m × n)

Every cell is visited at most once during BFS.

### Space Complexity

O(m × n)

In the worst case, the queue can contain every cell in the grid.



## 🧠 Key Insight

The most important idea is:

One BFS level represents one minute.

Because all rotten oranges spread simultaneously, we process all oranges belonging to the current level before increasing the minute counter.

The other important PHP optimization is using a queue pointer:

```php
$head = 0;

while ($head < count($queue)) {
    [$r, $c] = $queue[$head++];
}
```

Rather than using:

```php
array_shift($queue);
```

`array_shift()` reindexes the remaining array elements and can become inefficient for large queues.

Using `$head` lets us treat the PHP array like an efficient queue.


##  Pattern to Remember

This problem is a classic example of:

Matrix + Multi-Source BFS + Level/Distance Tracking

When you see a problem where:

- Multiple starting points spread simultaneously
- Movement happens in discrete steps
- You need the minimum number of steps/minutes

consider multi-source BFS.
