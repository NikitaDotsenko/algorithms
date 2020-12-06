<?php

declare(strict_types=1);

namespace Tests\Queue;

use Exercises\Queue\Queue;
use PHPUnit\Framework\TestCase;
use function method_exists;

class QueueTest extends TestCase
{
    /** @var Queue */
    private $queue;

    protected function setUp(): void
    {
        $this->queue = new Queue();
    }

    public function testHasMethods(): void
    {
        $this->assertTrue(
            method_exists(Queue::class, 'add'),
            'Class does not have method add'
        );
        $this->assertTrue(
            method_exists(Queue::class, 'remove'),
            'Class does not have method remove'
        );
        $this->assertTrue(
            method_exists(Queue::class, 'peek'),
            'Class does not have method peek'
        );
        $this->assertTrue(
            method_exists(Queue::class, 'zip'),
            'Class does not have static method zip'
        );
    }

    public function testCanCreateObject(): void
    {
        $this->assertIsObject($this->queue);
    }

    public function testCanAdd(): void
    {
        $this->queue->add(1);
        $this->queue->add(2);
        $this->queue->add(3);

        $this->assertTrue(true);
    }

    public function testCanRemove(): void
    {
        $this->queue->add(1);
        $this->queue->add(2);
        $this->queue->add(3);

        $this->assertSame(1, $this->queue->remove());
        $this->assertSame(2, $this->queue->remove());
        $this->assertSame(3, $this->queue->remove());
    }

    public function testCanPeek(): void
    {
        $this->queue->add(1);
        $this->queue->add(2);
        $this->queue->add(3);

        $this->queue->remove();
        $this->queue->add(1);

        $this->assertSame(2, $this->queue->peek());
    }

    public function testCanZip(): void
    {
        $queue1 = new Queue();
        $queue2 = new Queue();
        $queue3 = new Queue();

        $queue1->add(1);
        $queue1->add(2);
        $queue1->add(3);
        $queue1->add(4);
        $queue2->add('a');
        $queue2->add('b');
        $queue3->add('!');
        $queue3->add('@');

        $queue4 = Queue::zip($queue1, $queue2, $queue3);

        $this->assertSame(1, $queue4->remove());
        $this->assertSame('a', $queue4->remove());
        $this->assertSame('!', $queue4->remove());
        $this->assertSame(2, $queue4->remove());
        $this->assertSame('b', $queue4->remove());
        $this->assertSame('@', $queue4->remove());
        $this->assertSame(3, $queue4->remove());
        $this->assertSame(4, $queue4->remove());
        $this->assertNull($queue4->remove());
    }
}
