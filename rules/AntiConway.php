<?php

namespace GameOfLife\rules;

use GameOfLife\Field;
use Ulrichsg\Getopt;

/**
 * The AntiConway.
 * At 1, 2, 3, 4, 6, 7, 8 neighbour cells, the field is born and if the field is alive and got 2 neighbour cells it stays alive.
 * @package GameOfLife\rules
 */
class AntiConway extends BaseRule
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
     * Defines the AntiConway rule, which are the reversed StandardRules.
     * @param Field $_field
     * @return bool
     */
    public function calculateNewState(Field $_field): bool
    {
        $neighbourCount = $_field->numberOfLivingNeighbours();
        $result = 0;

        if ($neighbourCount === 0)
        {
            $result = 1;
        }
        if ($neighbourCount === 1)
        {
            $result = 1;
        }
        if ($neighbourCount === 2)
        {
            $result = 1;
        }
        if ($neighbourCount === 3)
        {
            $result = 1;
        }
        if ($neighbourCount === 4)
        {
            $result = 1;
        }
        if ($neighbourCount === 6 and $_field->isDead())
        {
            $result = 1;
        }
        if ($neighbourCount === 7)
        {
            $result = 1;
        }
        if ($neighbourCount === 8)
        {
            $result = 1;
        }

        return $result;
    }
}