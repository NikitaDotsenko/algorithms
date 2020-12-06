<?php

declare(strict_types=1);

namespace Tests\Graph;

use Exercises\Graph\BFSAlgorithm;
use Exercises\Graph\DFSAlgorithm;
use PHPUnit\Framework\TestCase;

/**
 * Class GraphTest
 *
 * @package Tests\Graph
 */
class GraphTest extends TestCase
{
    /** @var array */
    private $graph;

    /**
     * Initial test data.
     */
    protected function setUp(): void
    {
        $this->graph[1][2] = $this->graph[2][1] = 1;
        $this->graph[1][5] = $this->graph[5][1] = 1;
        $this->graph[5][2] = $this->graph[2][5] = 1;
        $this->graph[5][4] = $this->graph[4][5] = 1;
        $this->graph[4][3] = $this->graph[3][4] = 1;
        $this->graph[3][2] = $this->graph[2][3] = 1;
        $this->graph[6][4] = $this->graph[4][6] = 1;
    }

    public function testBfsAlgorithm(): void
    {
        $algorithm = new BFSAlgorithm();
        // Start from node = 1
        $path1 = $algorithm->BFS($this->graph, 1, []);

        $this->assertSame(6, $path1->pop());
        $this->assertSame(4, $path1->pop());
        $this->assertSame(3, $path1->pop());
        $this->assertSame(5, $path1->pop());
        $this->assertSame(2, $path1->pop());
        $this->assertSame(1, $path1->pop());

        // Start from the node 6
        $path2 = $algorithm->BFS($this->graph, 6, []);

        $this->assertSame(2, $path2->pop());
        $this->assertSame(1, $path2->pop());
        $this->assertSame(3, $path2->pop());
        $this->assertSame(5, $path2->pop());
        $this->assertSame(4, $path2->pop());
        $this->assertSame(6, $path2->pop());
    }

    public function testDFSAlgorithm(): void
    {
        $algorithm = new DFSAlgorithm();

        // Start from the node 4
        $path1 = $algorithm->DFS($this->graph, 4, []);
        $this->assertSame(5, $path1->pop());
        $this->assertSame(1, $path1->pop());
        $this->assertSame(2, $path1->pop());
        $this->assertSame(3, $path1->pop());
        $this->assertSame(6, $path1->pop());
        $this->assertSame(4, $path1->pop());

        $path2 = $algorithm->DFS($this->graph, 2, []);
        $this->assertSame(1, $path2->pop());
        $this->assertSame(5, $path2->pop());
        $this->assertSame(6, $path2->pop());
        $this->assertSame(4, $path2->pop());
        $this->assertSame(3, $path2->pop());
        $this->assertSame(2, $path2->pop());

    }
}
