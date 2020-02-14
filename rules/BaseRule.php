<?php

namespace GameOfLife\rules;

use GameOfLife\Field;
use Ulrichsg\Getopt;

/**
 * The Base-Rule.
 * With the function addOptions, you can add Options from outside of the gameoflife.php file.
 * The Initialize() function is only needed for adding extra options into a running function.
 * calculateNewState() is the main function and calculates the next State of the fields, based on the rules given in.
 * @package GameOfLife\rules
 */
abstract class BaseRule
{
    /**
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     * @return mixed
     */
    abstract public function addOptions(Getopt $_options);

    /**
     * Initialize more options into a running function.
     * @param Getopt $_options
     * @return mixed
     */
    abstract public function initialize(Getopt $_options);

    /**
     * Calculates the next state of the board, following the rules given in.
     * @param Field $_field
     * @return bool
     */
    abstract public function calculateNewState(Field $_field) : bool;
}