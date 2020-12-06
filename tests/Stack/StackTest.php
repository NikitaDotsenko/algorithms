<?php

declare(strict_types=1);

namespace Tests\Stack;

use Exercises\Stack\Stack;
use PHPUnit\Framework\TestCase;
use function method_exists;

/**
 * Class StackTest
 *
 * @package Tests\Stack
 */
class StackTest extends TestCase
{
    /** @var Stack */
    private $stack;

    /**
     * init test state.
     */
    protected function setUp(): void
    {
        $this->stack = new Stack();
    }

    /**
     * Assert that class has methods.
     */
    public function testHasMethods(): void
    {
        $this->assertTrue(
            method_exists(Stack::class, 'push'),
            'Class does not have method push'
        );
        $this->assertTrue(
            method_exists(Stack::class, 'pop'),
            'Class does not have method pop'
        );
        $this->assertTrue(
            method_exists(Stack::class, 'peek'),
            'Class does not have method peek'
        );
    }

    /**
     * Object Stack can be created.
     */
    public function testCanCreateObject(): void
    {
        $this->assertIsObject($this->stack);
    }

    /**
     * Can push to stack.
     */
    public function testCanPush(): void
    {
        $this->stack->push(1);
        $this->stack->push(2);
        $this->stack->push(3);
        $this->assertTrue(true);
    }

    /**
     * Can pop from stack.
     */
    public function testCanPop(): void
    {
        $this->stack->push(1);
        $this->stack->push(2);
        $this->stack->push(3);
        $this->assertSame(3, $this->stack->pop());
        $this->assertSame(2, $this->stack->pop());
        $this->assertSame(1, $this->stack->pop());
        $this->assertNull($this->stack->pop());
    }

    /**
     * Can peek element from stack.
     */
    public function testCanPeek(): void
    {
        $this->stack->push(1);
        $this->stack->push(2);
        $this->stack->push(3);

        $this->stack->pop();
        $this->stack->push(1);
        $this->assertSame(1, $this->stack->peek());
    }
}
