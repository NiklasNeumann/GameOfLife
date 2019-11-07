<?php

namespace GameOfLife\outputs;

use GameOfLife\Field;
use Ulrichsg\Getopt;

/**
 * Creates Console-output
 * Shows the output on console.
 * @package GameOfLife\outputs
 */
class Console extends BaseOutput
{
    /**
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     */
    public function addOptions(Getopt &$_options)
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
     * Outputs the field.
     * @param Field $_field
     */
    public function outputField(Field $_field)
    {
        $_field->printField();
    }

    /**
     * Finishes the output.
     */
    public function finishOutput()
    {

    }
}