<?php

namespace outputs;

use GameOfLife\Board;
use GameOfLife\outputs\Console;
use PHPUnit\Framework\TestCase;

class ConsoleTest extends TestCase
{
    public function testConsoleOutput()
    {
        $board = new Board(5, 5);
        $board->setBoardValue(3, 3, 1);
        $console = new Console();
        $console->outputBoard($board);

        $this->expectOutputString("     \n     \n     \n   $ \n     \n");
    }

    public function testFieldIsEmpty()
    {
        $board = new Board(5, 5);
        $console = new Console();
        $console->outputBoard($board);

        $this->expectOutputString("     \n     \n     \n     \n     \n");
    }
}
