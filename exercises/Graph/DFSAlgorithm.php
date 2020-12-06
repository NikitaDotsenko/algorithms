<?php

declare(strict_types=1);

namespace Exercises\Graph;

use SplQueue;
use SplStack;

/**
 * Class DFS
 *
 * @example Example graph that we will be work with:
 * $graph[1][2] = $graph[2][1] = 1;
 * $graph[1][5] = $graph[5][1] = 1;
 * $graph[5][2] = $graph[2][5] = 1;
 * $graph[5][4] = $graph[4][5] = 1;
 * $graph[4][3] = $graph[3][4] = 1;
 * $graph[3][2] = $graph[2][3] = 1;
 * $graph[6][4] = $graph[4][6] = 1;
 * PHP 7 Data Structures and Algorithms by Mizanur Rahman.pdf - page 490
 */
class DFSAlgorithm
{
    public function DFS(array $graph, int $start, array $visited): SplQueue
    {
        $stack = new SplStack;
        $path = new SplQueue;
        $stack->push($start);
        $visited[$start] = 1;
        while (!$stack->isEmpty()) {
            $node = $stack->pop();
            $path->enqueue($node);
            foreach ($graph[$node] as $key => $vertex) {
                if (!array_key_exists($key, $visited) && $vertex == 1) {
                    $visited[$key] = 1;
                    $stack->push($key);
                }
            }
        }
        return $path;
    }
}
