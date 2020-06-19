<?php

namespace GameOfLife\rules;

use GameOfLife\Field;
use Ulrichsg\Getopt;

/**
 * The StandardRule.
 * At 3 neighbour cells, the field is born and if the field is alive and got 2 neighbour cells it stays alive.
 * @package GameOfLife\rules
 */
class StandardRule extends BaseRule
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
     * Initialize more options into a running function.
     * @param Getopt $_options
     * @return mixed
     */
    public function initialize(Getopt $_options)
    {

    }

    /**
     * Defines the StandardRules of the GoL.
     * @param Field $_field
     * @return bool
     */
    public function calculateNewState(Field $_field): bool
    {
        $neighbourCount = $_field->numberOfLivingNeighbours();
        $result = 0;

        if ($neighbourCount === 3 || ($neighbourCount == 2 and $_field->isAlive()))
        {
            $result = 1;
        }

        return $result;
    }
}