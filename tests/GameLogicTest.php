<?php

namespace GameOfLife\tests;

use GameOfLife\Board;
use GameOfLife\GameLogic;
use GameOfLife\outputs\Console;
use GameOfLife\rules\StandardRule;
use PHPUnit\Framework\TestCase;

class GameLogicTest extends TestCase
{
    public function testIfCalculateNextBoardWorks()
    {
        $board = new Board(5, 5);
        $board->setBoardValue(1, 2, 1);
        $board->setBoardValue(2, 2, 1);
        $board->setBoardValue(3, 2, 1);

        $testBoard = Board::createFromArray
        ([
                [0, 0, 0, 0, 0],
                [0, 0, 1, 0, 0],
                [0, 0, 1, 0, 0],
                [0, 0, 1, 0, 0],
                [0, 0, 0, 0, 0]]
        );

        $rule = new StandardRule();

        $gameLogic = new GameLogic($rule);
        $gameLogic->calculateNextBoard($board);

        $this->assertTrue($board->isEqualTo($testBoard));
    }

    public function testIfALoopIsDetected()
    {
        $board = new Board(5, 5);
        $board->setBoardValue(1, 2, 1);
        $board->setBoardValue(2, 2, 1);
        $board->setBoardValue(3, 2, 1);

        $rule = new StandardRule();

        $gameLogic = new GameLogic($rule);
        $gameLogic->calculateNextBoard($board);
        $gameLogic->calculateNextBoard($board);
        $gameLogic->calculateNextBoard($board);

        $this->assertTrue($gameLogic->isLoopDetected());
    }
}
