<?php

namespace GameOfLife\outputs;

use GameOfLife\Board;
use Icecave\Isolator\IsolatorTrait;
use Ulrichsg\Getopt;

/**
 * The Base-Output.
 * With the function addOptions(), you can add Options from outside of the gameoflife.php file.
 * startOutput() starts the output, outputBoard outputs the boards and finishOutput() simply finishes the output.
 * @package GameOfLife\outputs
 */
abstract class BaseOutput
{
    use IsolatorTrait;

    /**
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     * @return mixed
     */
    abstract public function addOptions(Getopt $_options);

    /**
     * Starts the output.
     * @param Getopt $_options
     * @return mixed
     */
    abstract public function startOutput(Getopt $_options);

    /**
     * Outputs the board.
     * @param Board $_board
     * @return mixed
     */
    abstract public function outputBoard(Board $_board);

    /**
     * Finishes the output.
     * @return mixed
     */
    abstract public function finishOutput();
}