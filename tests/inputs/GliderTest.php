<?php

namespace inputs;

use GameOfLife\Board;
use GameOfLife\inputs\Glider;
use GameOfLife\outputs\Console;
use PHPUnit\Framework\TestCase;
use Ulrichsg\Getopt;

require_once "Getopt.php";

class GliderTest extends TestCase
{
    public function testFillBoardYieldsNotEmptyBoard()
    {
        $board = new Board(5, 5);
        $glider = new Glider();
        $options = new Getopt();
        $console = new Console();

        $glider->fillBoard($board, $console, $options);
        $isEmpty = true;

        for ($y = 0; $y < $board->height(); $y++)
        {
            for ($x = 0; $x < $board->width(); $x++)
            {
                if ($board->boardValue($x, $y) != 0)
                {
                    $isEmpty = false;
                }
            }
        }

        $this->assertFalse($isEmpty);

        return $board;
    }

    /**
     * @depends testFillBoardYieldsNotEmptyBoard
     * @param Board $board
     */
    public function testGliderPattern(Board $board)
    {
        $pattern = [
            [0, 0, 0, 0, 0],
            [0, 0, 1, 0, 0],
            [0, 0, 0, 1, 0],
            [0, 1, 1, 1, 0],
            [0, 0, 0, 0, 0]];

        $board2 = Board::createFromArray($pattern);

        $this->assertTrue($board->isEqualTo($board2));
    }

    public function testFieldIsTooSmallForGlider()
    {
        $board = new Board(2, 2);
        $glider = new Glider();
        $glider->fillBoard($board,new Console(), new Getopt());

        $expected = [
            [0,1],
            [1,1]];

        $board2 = Board::createFromArray($expected);

        $this->assertTrue($board->isEqualTo($board2));
    }

    public function testCustomPosition()
    {
        $board = new Board(5, 5);
        $option = new Getopt();
        $glider = new Glider();
        $glider->addOptions($option);
        $option->parse("-x 0 -y 0");
        $glider->fillBoard($board, new Console(), $option);

        $pattern = [
            [0, 1, 0, 0, 0],
            [0, 0, 1, 0, 0],
            [1, 1, 1, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]];

        $board2 = Board::createFromArray($pattern);

        $this->assertTrue($board->isEqualTo($board2));
    }
}
