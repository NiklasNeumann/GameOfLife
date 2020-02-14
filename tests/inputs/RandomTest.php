<?php

namespace inputs;

use GameOfLife\Board;
use GameOfLife\inputs\Random;
use GameOfLife\outputs\Console;
use PHPUnit\Framework\TestCase;
use Ulrichsg\Getopt;

class RandomTest extends TestCase
{
    public function testBoardIsNotEmpty()
    {
        $board = new Board(5, 5);
        $random = new Random();
        $random->fillBoard($board, new Console(), new Getopt());

        $isNotEmpty = true;

        for ($y = 0; $y < $board->height(); $y++)
        {
            for ($x = 0; $x < $board->width(); $x++)
            {
                if ($board->boardValue($x, $y) != 0)
                {
                    $isNotEmpty = false;
                }
            }
        }

        $this->assertFalse($isNotEmpty);
    }

    public function testAddOptions()
    {
        $board = new Board(5, 5);
        $random = new Random();
        $option = new Getopt();
        $random->addOptions($option);
        $option->parse("--filling 20");
        $random->fillBoard($board, new Console(), $option);


        $isNotEmpty = true;

        for ($y = 0; $y < $board->height(); $y++)
        {
            for ($x = 0; $x < $board->width(); $x++)
            {
                if ($board->boardValue($x, $y) != 0)
                {
                    $isNotEmpty = false;
                }
            }
        }
        $this->assertFalse($isNotEmpty);
    }

    public function testFilling100Fills100Percent()
    {
        $board = new Board(5, 5);
        $random = new Random();
        $option = new Getopt();
        $random->addOptions($option);
        $option->parse("--filling 100");
        $random->fillBoard($board, new Console(), $option);


        $isFilled = true;

        for ($y = 0; $y < $board->height(); $y++)
        {
            for ($x = 0; $x < $board->width(); $x++)
            {
                if ($board->boardValue($x, $y) == 0)
                {
                    $isFilled = false;
                }
            }
        }
        $this->assertTrue($isFilled);
    }
}
