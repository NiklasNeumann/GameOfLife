<?php

namespace GameOfLife\inputs;

use GameOfLife\Field;
use GameOfLife\outputs\Console;
use Ulrichsg\Getopt;

/**
 * With the function addOptions, you can add Options from outside of the gameoflife.php file.
 * The function fillField can be used to fill the $field variable in Field.php with the wished field-stats.
 * @package GameOfLife\inputs
 */
abstract class BaseInput
{
    /**
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     */
    abstract public function addOptions(Getopt &$_options);

    /**
     * Fills the empty field.
     * @param Field $_field
     * @param Console $_console
     * @param Getopt $_options
     */
    abstract public function fillField(Field &$_field, Console &$_console, Getopt $_options);
}