<?php

namespace GameOfLife;

/**
 * Fields of the Board.
 * This Class enables the use and customization of every Field of the board.
 * @package GameOfLife
 */
class Field
{
    private $board;
    private $x;
    private $y;
    private $value = 0;

    /**
     * Field constructor.
     * @param Board $_board of which the fields can be customized.
     * @param $_x int width of the board
     * @param $_y int height of the board
     */
    public function __construct(Board $_board, $_x, $_y)
    {
        $this->board = $_board;
        $this->x = $_x;
        $this->y = $_y;
    }

    /**
     * Set the state of the Field.
     * @param bool $_state
     */
    public function setValue(bool $_state)
    {
        $this->value = $_state;
    }

    /**
     * Check if the Field is alive.
     * @return int
     */
    public function isAlive()
    {
        return $this->value;
    }

    /**
     * Check if the Field is dead.
     * @return bool
     */
    public function isDead()
    {
        return !$this->isAlive();
    }

    /**
     * Return the x-position of the Field.
     * @return mixed
     */
    public function x()
    {
        return $this->x;
    }

    /**
     * Return the y-position of the Field.
     * @return mixed
     */
    public function y()
    {
        return $this->y;
    }

    /**
     * Count the number of living neighbours.
     * @return int
     */
    public function numberOfLivingNeighbours()
    {
        return $this->board->countLivingNeighboursOfField($this);
    }

    /**
     * Count the number of dead neighbours.
     * @return int
     */
    public function numberOfDeadNeighbours()
    {
        return 8 - $this->numberOfLivingNeighbours();
    }
}