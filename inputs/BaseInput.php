<?php

namespace GameOfLife\inputs;

use GameOfLife\Field;
use Ulrichsg\Getopt;

/**
 * Base input
 * With the function addOptions, you can add Options from outside of the gameoflife.php file.
 * The function fillField can be used to fill the $field variable in Field.php with the wished field-stats.
 * @package GameOfLife\inputs
 */
abstract class BaseInput
{
    abstract public function addOptions(Getopt &$_options);
    abstract public function fillField(Field &$_field, Getopt $_options);
}