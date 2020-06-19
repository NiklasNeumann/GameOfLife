<?php

namespace rules;

use GameOfLife\Board;
use GameOfLife\Field;
use PHPUnit\Framework\TestCase;

class FieldTest extends TestCase
{
    public function testIfXAndYWorks()
    {
        $board = new Board(5, 5);
        $field = new Field($board, 5, 5);

        $this->assertEquals(5, $field->y());
        $this->assertEquals(5, $field->x());
    }

    public function testSetValue()
    {
        $board = new Board(5, 5);
        $field = new Field($board, 0, 0);

        $this->assertTrue($field->isDead());
        $field->setValue(1);
        $this->assertTrue($field->isAlive());
    }

    public function testDeadOrAlive()
    {
        $board = new Board(5, 5);
        $field = new Field($board, 0, 0);

        $field->setValue(1);
        $this->assertTrue($field->isAlive());
        $field->setValue(0);
        $this->assertTrue($field->isDead());
    }

    public function testNumberOfLivingNeighboursIsWorkingAndNumberOfDeadNeighboursIsWorking()
    {
        $testBoard = Board::createFromArray
        ([
            [0, 0, 0, 0, 0],
            [0, 1, 0, 1, 0],
            [0, 0, 0, 0, 0],
            [1, 0, 0, 0, 1],
            [0, 1, 1, 1, 0]
        ]);

        $field = $testBoard->field(2, 2);
        $this->assertEquals(2, $field->numberOfLivingNeighbours());
        $this->assertEquals(6, $field->numberOfDeadNeighbours());
    }
}
