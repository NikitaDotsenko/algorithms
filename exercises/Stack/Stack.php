<?php

declare(strict_types=1);

namespace Exercises\Stack;

/**
 * Create a Stack.
 *
 * When stack is empty pop and peek methods should return null.
 *
 * @example $stack = new Stack();
 * $stack->push(1);
 * $stack->push(2);
 * $stack->peek() === 1;
 * $stack->pop() === 1;
 */
class Stack
{
    /**
     * Stack.
     *
     * @var array
     */
    private $stack = [];

    /**
     * Cursor.
     *
     * @var int
     */
    private $cursor = 0;

    /**
     * Can be refactored to array_push;
     *
     * @param int $value
     */
    public function push(int $value): void
    {
        $this->stack[$this->cursor] = $value;
        $this->cursor++;
    }

    /**
     * Can be refactored to array_pop;
     *
     * @return int|null
     */
    public function pop(): ?int
    {
        if ($this->cursor > 0) {
            $value = $this->stack[$this->cursor - 1];
            unset($this->stack[$this->cursor]);

            if ($this->cursor !== 0) {
                $this->cursor--;
            }

            return $value;
        }

        return null;
    }

    /**
     * Get last element.
     *
     * @return int|null
     */
    public function peek(): ?int
    {
        return $this->cursor === 0
            ? null
            : $this->stack[$this->cursor - 1];
    }
}
