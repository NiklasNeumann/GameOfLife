<?php

namespace GameOfLife\rules;

use GameOfLife\Field;
use Ulrichsg\Getopt;

/**
 * The Two45Rule.
 * At 2, 4, 5 neighbour cells, the field is born and if the field is alive and got 3 neighbour cells it stays alive.
 * @package GameOfLife\rules
 */
class Two45Rule extends BaseRule
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
     * Defines the rule 245/3 for the GoL.
     * @param Field $_field
     * @return bool
     */
    public function calculateNewState(Field $_field): bool
    {
        $neighbourCount = $_field->numberOfLivingNeighbours();
        $result = 0;

        if ($neighbourCount === 2)
        {
            $result = 1;
        }
        if ($neighbourCount === 4)
        {
            $result = 1;
        }
        if ($neighbourCount === 5)
        {
            $result = 1;
        }
        if ($neighbourCount === 3 and $_field->isDead())
        {
            $result = 1;
        }


        return $result;
    }
}