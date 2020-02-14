<?php

namespace GameOfLife\inputs;

use GameOfLife\Board;
use GameOfLife\outputs\Console;
use Ulrichsg\Getopt;

/**
 * Fills the board from user input.
 *
 * With the function addOptions, you can add Options from outside of the gameoflife.php file.
 * The function fillBoard can be used to fill the $board variable in Board.php with the wished board-stats.
 * @package GameOfLife\inputs
 */
class User extends BaseInput
{
    /**
     * Adds options.
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options Option manager to check for optional arguments.
     */
    public function addOptions(Getopt $_options)
    {}

    /**
     * Fills a field.
     *
     * @param Board $_board Board to prepare.
     * @param Console $_console
     * @param Getopt $_options Option manager to check for optional arguments.
     */
    public function fillBoard(Board $_board, Console $_console, Getopt $_options)
    {
        echo "To change a cell type the coordinates, optionally the state, separated by commas";
        echo "and hit enter.\n";
        echo "e.g. \"5,14,1\" creates a living cell at 5|14.\n";
        echo "If you are finished type exit.\n";
        while(1)
        {
            $_console->outputBoard($_board);
            $line = readline("<<");
            if( $line == "exit" )
                break;
            $coords = explode(",", $line);
            if(count($coords) == 2)
            {
                $_board->setBoardValue($coords[0],$coords[1],1);
            }
            if(count($coords) == 3)
            {
                $_board->setBoardValue($coords[0],$coords[1],$coords[2]);
            }
        }
    }
}
