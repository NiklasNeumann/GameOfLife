<?php

namespace GameOfLife;

use GameOfLife\rules\BaseRule;

class GameLogic
{
    private $rule;
    private $history = [];
    private $loopDetected = false;

    public function __construct(BaseRule $_rule)
    {
        $this->rule = $_rule;
    }

    public function calculateNextBoard(Board $_board)
    {
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


    public function isLoopDetected()
    {
        return $this->loopDetected;
    }
}