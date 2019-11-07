<?php

namespace GameOfLife\outputs;

use GameOfLife\Field;
use Ulrichsg\Getopt;

/**
 * The Base-Output
 * With the function addOptions(), you can add Options from outside of the gameoflife.php file.
 * startOutput() starts the output, outputField outputs the fields and finishOutput() simply finishes the output.
 * @package GameOfLife\outputs
 */
abstract class BaseOutput
{
    /**
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     * @return mixed
     */
    abstract public function addOptions(Getopt &$_options);

    /**
     * Starts the output.
     * @param Getopt $_options
     * @return mixed
     */
    abstract public function startOutput(Getopt $_options);

    /**
     * Outputs the field.
     * @param Field $_field
     * @return mixed
     */
    abstract public function outputField(Field $_field);

    /**
     * Finishes the output.
     * @return mixed
     */
    abstract public function finishOutput();
}