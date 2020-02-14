<?php

namespace rules;

use GameOfLife\Board;
use GameOfLife\rules\StandardRule;
use PHPUnit\Framework\TestCase;

class StandardRuleTest extends TestCase
{
    public function testCellStaysAliveIfTwoNeighboursAreAlive()
    {
        $board = new Board(5, 5);
        $board->setBoardValue(1, 2, 1);
        $board->setBoardValue(2, 2, 1);
        $board->setBoardValue(3, 2, 1);
        $field = $board->field(2, 2);

        $rule = new StandardRule();

        $this->assertTrue($rule->calculateNewState($field));
    }

    public function testCellSetAliveIfThreeNeighboursAreAlive()
    {
        $board = new Board(5, 5);
        $board->setBoardValue(1, 2, 1);
        $board->setBoardValue(2, 2, 1);
        $board->setBoardValue(3, 2, 1);
        $field = $board->field(2, 1);

        $rule = new StandardRule();

        $this->assertTrue($rule->calculateNewState($field));
    }

    public function testCellStillAliveWithThreeAliveNeighbours()
    {
        $board = new Board(5, 5);
        $board->setBoardValue(1, 2, 1);
        $board->setBoardValue(2, 2, 1);
        $board->setBoardValue(3, 2, 1);
        $board->setBoardValue(2, 1, 1);
        $field = $board->field(2, 1);

        $rule = new StandardRule();

        $this->assertTrue($rule->calculateNewState($field));
    }
}
