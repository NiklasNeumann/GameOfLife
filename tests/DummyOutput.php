<?php

namespace GameOfLife\tests;

use GameOfLife\Field;
use GameOfLife\outputs\BaseOutput;
use Ulrichsg\Getopt;

/**
 * The DummyOutput
 * This output is a support class for the Field class and is supposed to mock the BaseOutput, so it can be used for Unit-Tests.
 * @package GameOfLife\tests
 */
class DummyOutput extends BaseOutput
{
    /**
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     * @return mixed
     */
    public function addOptions(Getopt $_options)
    {

    }

    /**
     * Starts the output.
     * @param Getopt $_options
     * @return mixed
     */
    public function startOutput(Getopt $_options)
    {

    }

    /**
     * Outputs the field.
     * @param Field $_field
     * @return mixed
     */
    public function outputField(Field $_field)
    {

    }

    /**
     * Finishes the output.
     * @return mixed
     */
    public function finishOutput()
    {

    }
}