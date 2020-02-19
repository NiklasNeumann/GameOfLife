<?php

namespace GameOfLife;

/**
 * The playing board of a game of live simulation.
 * Constructs a board with the width and height given into the constructor.
 * Also an array can be used to create a new board or compare it with an already existing one.
 * @package gameoflife
 */
class Board
{
    protected $board = [];
    protected $width;
    protected $height;

    /**
     * Board constructor
     * @param $_width int
     * @param $_height int
     */
    public function __construct($_width, $_height)
    {
        $this->width = $_width;
        $this->height = $_height;

        $this->constructBoard();
    }

    /**
     * Create board from Array.
     * @param $_array array
     * @return board
     */
    public static function createFromArray($_array)
    {
        $height = count($_array);
        $width = count($_array[0]);

        $board = new Board($width, $height);

        for($y = 0; $y < $height; $y++)
        {
            for($x = 0; $x < $width; $x++)
            {
                $board->setBoardValue($x, $y, $_array[$y][$x]);
            }
        }
        return $board;
    }

    /**
     * Construct empty board
     */
    private function constructBoard()
    {
        for ($y = 0; $y < $this->height; $y++)
        {
            for ($x = 0; $x < $this->width; $x++)
            {
                $this->board[$x][$y] = new Field($this, $x, $y);
            }
        }
    }

    /**
     * Set board's cells
     * @param $_x int for the x-Position of the cells
     * @param $_y int for the y-position of the cells
     * @param $_state bool for the status of cells (dead or alive)
     */
    public function setBoardValue($_x, $_y, $_state)
    {
        if ($_x >= 0 and $_x < $this->width and $_y >= 0 and $_y < $this->height)
        {
            $this->board[$_x][$_y]->setValue($_state);
        }
    }

    /**
     * Get the board's cells
     * @param $_x int for the x-Position of the cells
     * @param $_y int for the y-position of the cells
     * @return mixed
     */
    public function boardValue($_x, $_y)
    {
        return $this->board[$_x][$_y]->isAlive();
    }

    /**
     * @return mixed
     */
    public function height()
    {
        return $this->height;
    }

    /**
     * @return mixed
     */
    public function width()
    {
        return $this->width;
    }

    /**
     * Compare board with parameter board.
     * @param Board $_board
     * @return bool
     */
    public function isEqualTo(Board $_board)
    {
        $isEqual = true;

        if ($this->width != $_board->width() or $this->height != $_board->height())
        {
            return false;
        }

        for($y = 0; $y < $this->height(); $y++)
        {
            for($x = 0; $x < $this->width(); $x++)
            {
                if($this->boardValue($x, $y) != $_board->boardValue($x,$y))
                {
                    $isEqual = false;
                }
            }
        }
        return $isEqual;
    }

    /**
     * @param $_x
     * @param $_y
     * @return Field
     */
    public function field($_x, $_y)
    {
        if($_x < $this->width() or $_y < $this->height())
        {
            return $this->board[$_x][$_y];
        }
    }

    /**
     * Count living neighbours.
     * @param $_field
     * @return int Of the neighbour-count
     */
    public function getNeighboursOfField(Field $_field)
    {
        $neighbours = 0;
        $y = $_field->y();
        $x = $_field->x();

        if($y < 0 or $x < 0 or $y > $this->height or $x > $this->width)
        {
            return -1;
        }

        for ($ny = $y - 1; $ny <= $y + 1; $ny++)
        {
            for ($nx = $x - 1; $nx <= $x + 1; $nx++)
            {
                if ($nx >= $this->width or $nx < 0)
                {
                    continue;
                }
                if ($ny >= $this->height or $ny < 0)
                {
                    continue;
                }
                if ($nx == $x and $ny == $y)
                {
                    continue;
                }

                if ($this->boardValue($nx, $ny) == 1)
                {
                    $neighbours++;
                }
            }
        }
        return $neighbours;
    }
}
