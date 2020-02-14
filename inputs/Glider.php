<?php

namespace GameOfLife\inputs;

use GameOfLife\Board;
use GameOfLife\outputs\Console;
use Ulrichsg\Getopt;

/**
 * Generates a board with a glider.
 * The glider's position can be set manually by using the "x" and "y" parameters.
 */
class Glider extends BaseInput
{
    /**
     * Add options.
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     */
    public function addOptions(Getopt $_options)
    {
        $_options->addOptions(
            [
                ['x', "x", Getopt::REQUIRED_ARGUMENT, "Allows to set the x-position of the glider on the board."],
                ['y', "y", Getopt::REQUIRED_ARGUMENT, "Allows to set the y-position of the glider on the board."]
            ]);
    }

    /**
     * Fill board.
     * A Glider will be placed at the wished position on the board. The X- and Y-coordinates will be set via parameter.
     * @param Board $_board
     * @param Console $_console
     * @param Getopt $_options
     */
    public function fillBoard(Board $_board, Console $_console, Getopt $_options)
    {
        $offsetX = floor($_board->width() / 2 - 1.5);
        $offsetY = floor($_board->height() / 2 - 1.5);

        if ($_options->getOption("x") != null)
        {
            $offsetX = intval($_options->getOption("x"));
        }
        if ($_options->getOption("y") != null)
        {
            $offsetY = intval($_options->getOption("y"));
        }

        $_board->setBoardValue(1+$offsetX,0+$offsetY,1);
        $_board->setBoardValue(2+$offsetX,1+$offsetY,1);
        $_board->setBoardValue(2+$offsetX,2+$offsetY,1);
        $_board->setBoardValue(0+$offsetX,2+$offsetY,1);
        $_board->setBoardValue(1+$offsetX,2+$offsetY,1);
    }
}
