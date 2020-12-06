<?php

declare(strict_types=1);

namespace Exercises\Queue;

/**
 * Create a Queue.
 *
 * When queue is empty remove and peek methods should return null.
 *
 * @property mixed[] $queue
 * @method void add(mixed $value)
 * @method mixed|null remove()
 * @method mixed|null peek()
 * @method static self zip(self ...$queues) interweaves two provided queues
 * @example $queue1 = new Queue();
 * $queue1->add(1);
 * $queue1->add(2);
 * $queue1->add(3);
 * $queue1->peek() === 3;
 * $queue1->remove() === 3;
 *
 * $queue2 = new Queue();
 *
 * $queue1->add('a');
 * $queue1->add('b');
 * $queue1->add('c');
 *
 * Queue::zip(queue1, queue2) -> [1, 'a', 2, 'b', 'c']
 */
class Queue
{
    /**
     * @var mixed[]
     */
    private $queue = [];

    /**
     * @var int
     */
    private $cursor = 0;

    /**
     * Add to queue.
     *
     * @param mixed $value
     */
    public function add($value): void
    {
        $this->queue[$this->cursor] = $value;
        $this->cursor++;
    }

    /**
     * Get last element.
     *
     * @return mixed
     */
    public function peek()
    {
        return count($this->queue)
            ? $this->queue[0]
            : null;
    }

    /**
     * Can be refactored to array_shift.
     *
     * @return mixed
     */
    public function remove()
    {
        if ($this->cursor <= 0) {
            return null;
        }

        $value = $this->queue[0];

        unset($this->queue[0]);

        $clonedQueue = $this->queue;

        foreach ($clonedQueue as $key => $item) {
            $clonedQueue[$key - 1] = $item;
        }
        unset($clonedQueue[count($clonedQueue) - 1]);

        $this->queue = $clonedQueue;

        if ($this->cursor > 0) {
            --$this->cursor;
        }

        return $value;
    }

    /**
     * Interweave queues.
     *
     * @param mixed ...$queues
     *
     * @return Queue
     */
    public static function zip(...$queues): Queue
    {
        $queuesLength = count($queues);
        $interweavedQueue = new Queue();

        while ($queuesLength) {
            foreach ($queues as $key => $queue) {
                if (!$queue->peek()) {
                    --$queuesLength;
                    unset($queues[$key]);
                    continue;
                }
                $interweavedQueue->add($queue->peek());
                $queue->remove();
            }
        }

        return $interweavedQueue;
    }
}
