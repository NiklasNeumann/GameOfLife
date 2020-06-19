<?php

namespace GameOfLife\inputs;

use GameOfLife\Board;
use GameOfLife\outputs\Console;
use Ulrichsg\Getopt;

/**
 * Generates a board with random living cells.
 * The filling of the board can be set with the "filling" parameter.
 */
class Random extends BaseInput
{
    /**
     * Add options.
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     */
    public function addOptions(Getopt $_options)
    {
        $_options->addOptions
        ([
                ['f', "filling", Getopt::REQUIRED_ARGUMENT, "Allows to set the percentage amount of living cells on the board."]
        ]);
    }

    /**
     * Fill board.
     * The board will be filled with the wished number of cells. The filling will be set via parameter.
     * @param Board $_board
     * @param Console $_console
     * @param Getopt $_options
     */
    public function fillBoard(Board $_board, Console $_console, Getopt $_options)
    {
        $filling = intval($_options->getOption("filling"));

        if ($filling == 0)
        {
            $filling = 50;
        }

        for ($y = 0; $y < $_board->height(); $y++)
        {
            for ($x = 0; $x < $_board->width(); $x++)
            {
                if ($filling > rand(0, 99))
                {
                    $_board->setBoardValue($x, $y, 1);
                }
            }
        }
    }
}