<?php

namespace GameOfLife\rules;

use GameOfLife\Field;
use Ulrichsg\Getopt;

/**
 * The CopyRule.
 * At 1, 3, 5, 7 neighbour cells, the field is born and stays alive if it had been alive.
 * @package GameOfLife\rules
 */
class CopyRule extends BaseRule
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
     * Defines the CopyRule and generates a self-reproducing system.
     * @param Field $_field
     * @return bool
     */
    public function calculateNewState(Field $_field): bool
    {
        $neighbourCount = $_field->numberOfLivingNeighbours();
        $result = 0;

        if ($neighbourCount === 1)
        {
            $result = 1;
        }
        if ($neighbourCount === 3)
        {
            $result = 1;
        }
        if ($neighbourCount === 5)
        {
            $result = 1;
        }
        if ($neighbourCount === 7)
        {
            $result = 1;
        }

        return $result;
    }
}