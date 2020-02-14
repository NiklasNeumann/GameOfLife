<?php

namespace GameOfLife\outputs;

use GameOfLife\Board;
use Ulrichsg\Getopt;

/**
 * Outputs the board to console.
 * Shows the output on console.
 * @package GameOfLife\outputs
 */
class Console extends BaseOutput
{
    /**
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     */
    public function addOptions(Getopt $_options)
    {

    }

    /**
     * Starts the output.
     * @param Getopt $_options
     */
    public function startOutput(Getopt $_options)
    {

    }

    /**
     * Prints and outputs the board.
     * Generates a field and replaces 1->"$" and 0->" ".
     * @param Board $_board
     */
    public function outputBoard(Board $_board)
    {
        $width = $_board->width();
        $height = $_board->height();

        for ($y = 0; $y < $height; $y++)
        {
            for ($x = 0; $x < $width; $x++)
            {
                echo($_board->boardValue($x,$y) ? "$" : " ");
            }
            echo "\n";
        }
    }

    /**
     * Finishes the output.
     */
    public function finishOutput()
    {

    }
}