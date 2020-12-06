<?php

declare(strict_types=1);

namespace Exercises\Graph;

use SplQueue;

/**
 * Class BFS
 *
 * @example Example graph that we will be work with:
 * $graph[1][2] = $graph[2][1] = 1;
 * $graph[1][5] = $graph[5][1] = 1;
 * $graph[5][2] = $graph[2][5] = 1;
 * $graph[5][4] = $graph[4][5] = 1;
 * $graph[4][3] = $graph[3][4] = 1;
 * $graph[3][2] = $graph[2][3] = 1;
 * $graph[6][4] = $graph[4][6] = 1;
 * PHP 7 Data Structures and Algorithms by Mizanur Rahman.pdf - page 487
 * Between 2 nodes we should chose one that declared earlier than second like it's queue;
 * @example 5-1 earlier than 5-2 and 5-2 earlier than 5-4
 */
class BFSAlgorithm
{
    public function BFS(array $graph, int $start, array $visited): SplQueue
    {
        $queue = new SplQueue;
        $path = new SplQueue;
        $queue->enqueue($start);
        $visited[$start] = 1;
        while (!$queue->isEmpty()) {
            $node = $queue->dequeue();
            $path->enqueue($node);
            foreach ($graph[$node] as $key => $vertex) {
                if (!array_key_exists($key, $visited) && $vertex == 1) {
                    $visited[$key] = 1;
                    $queue->enqueue($key);
                }
            }
        }
        return $path;
    }
}
