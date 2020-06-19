<?php

namespace GameOfLife;

use GameOfLife\rules\BaseRule;

/**
 * The GameLogic
 * Defines how cells die and how cells survive. The next board will then be calculated and can be used by the output.
 * @package GameOfLife
 */
class GameLogic
{
    private $rule;
    private $history = [];
    private $loopDetected = false;

    /**
     * GameLogic constructor.
     * @param BaseRule $_rule
     */
    public function __construct(BaseRule $_rule)
    {
        $this->rule = $_rule;
    }

    /**
     * Calculates the next Board
     * Uses the rule given by the constructor to calculate and return the next version of the Board.
     * @param Board $_board
     */
    public function calculateNextBoard(Board $_board)
    {
        $nextBoard = [];

        for ($y = 0; $y < $_board->height(); $y++)
        {
            for ($x = 0; $x < $_board->width(); $x++)
            {
                $nextBoard[$y][$x] = 0;
            }
        }

        for ($y = 0; $y < $_board->height(); $y++)
        {
            for ($x = 0; $x < $_board->width(); $x++)
            {
                $nextBoard[$y][$x] = $this->rule->calculateNewState($_board->field($x, $y));
            }
        }

        for ($y = 0; $y < $_board->height(); $y++)
        {
            for ($x = 0; $x < $_board->width(); $x++)
            {
                $_board->setBoardValue($x, $y, $nextBoard[$y][$x]);
            }
        }

        foreach ($this->history as $previousBoard)
        {
            if ($_board->isEqualTo($previousBoard))
            {
                $this->loopDetected = true;
            }
        }

        $this->history[] = Board::createFromArray($nextBoard);

        if (count($this->history) > 2)
        {
            array_shift($this->history);
        }
    }

    /**
     * The LoopDetector
     * @return bool
     */
    public function isLoopDetected()
    {
        return $this->loopDetected;
    }
}