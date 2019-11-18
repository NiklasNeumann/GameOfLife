<?php

namespace GameOfLife\outputs;

use GameOfLife\Field;
use Ulrichsg\Getopt;

/**
 * Outputs the field to console.
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
     * Prints and outputs the field.
     * Generates a field and replaces 1->"$" and 0->" ".
     * @param Field $_field
     */
    public function outputField(Field $_field)
    {
        $width = $_field->width();
        $height = $_field->height();

        for ($y = 0; $y < $height; $y++)
        {
            for ($x = 0; $x < $width; $x++)
            {
                echo($_field->fieldValue($x,$y) ? "$" : " ");
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