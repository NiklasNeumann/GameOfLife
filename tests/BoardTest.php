<?php

namespace GameOfLife\tests;

use PHPUnit\Framework\TestCase;
use GameOfLife\Board;
use GameOfLife\Field;


class BoardTest extends TestCase
{
    public function testConstructedBoardIsEmpty()
    {
        $_board = new Board(50, 25);
        $isEmpty = true;

        for ($y = 0; $y < $_board->height(); $y++)
        {
            for ($x = 0; $x < $_board->width(); $x++)
            {
                if ($_board->boardValue($x, $y) != 0)
                {
                    $isEmpty = false;
                }
            }
        }

        $this->assertTrue($isEmpty);

        return $_board;
    }

    /**
     * @depends clone testConstructedBoardIsEmpty
     * @param Board $_board
     */
    public function testBoardElements(Board $_board)
    {
        $this->assertEquals(50, $_board->width());

        $this->assertEquals(25, $_board->height());
    }

    public function testIfTheIsEqualFunctionWorks()
    {
        $board = new Board(5, 5);
        $board2 = new Board(5, 5);

        $this->assertTrue($board->isEqualTo($board2));
    }

    /**
     *
     */
    public function testCreateFromArrayWorks()
    {
        $board = new Board(5, 5);
        $board->setBoardValue(1, 1, 1);
        $board->setBoardValue(3, 1, 1);

        $board->setBoardValue(0, 3, 1);
        $board->setBoardValue(1, 4, 1);
        $board->setBoardValue(2, 4, 1);
        $board->setBoardValue(3, 4, 1);
        $board->setBoardValue(4, 3, 1);

        $testBoard = Board::createFromArray
        ([
            [0, 0, 0, 0, 0],
            [0, 1, 0, 1, 0],
            [0, 0, 0, 0, 0],
            [1, 0, 0, 0, 1],
            [0, 1, 1, 1, 0]]
        );

        $this->assertTrue($board->isEqualTo($testBoard));
    }

    public function testCreateFromArrayInSmallSize()
    {
        $board = new Board(3, 3);
        $board->setBoardValue(0, 2, 1);

        $testBoard = Board::createFromArray
        ([
                [0, 0, 0],
                [0, 0, 0],
                [1, 0, 0]
        ]);

        $this->assertTrue($board->isEqualTo($testBoard));
    }

    public function testGetNeighboursOfFieldIsOutOfBounds()
    {
        $board = new Board(5, 5);
        $field = new Field($board, 6, -1);

        $this->assertEquals(-1, $board->countLivingNeighboursOfField($field));
    }

    /**
     * @depends clone testConstructedBoardIsEmpty
     * @param Board $_board
     */
    public function testSetBoardValue(Board $_board)
    {
        $_board->setBoardValue(25, 15, 1);
        $this->assertEquals(1, $_board->boardValue(25, 15));
    }

    public function testCompareWithSmallerBoard()
    {
        $board = new Board(5, 5);
        $board2 = new Board(3, 2);

        $this->assertFalse($board->isEqualTo($board2));
    }

    public function testCompareWithLargerBoard()
    {
        $field = new Board(5, 5);
        $field2 = new Board(3, 2);

        $this->assertFalse($field->isEqualTo($field2));
    }

    public function testCompareToDifferentBoards()
    {
        $board = new Board(5, 5);
        $board2 = new Board(5, 5);

        $board->setBoardValue(3, 3, 1);

        $this->assertFalse($board->isEqualTo($board2));
    }

}