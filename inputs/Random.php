<?php

namespace GameOfLife\inputs;

use GameOfLife\Field;
use Ulrichsg\Getopt;

class Random extends BaseInput
{
    /**
     * Add options
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     */
    public function addOptions(Getopt &$_options)
    {
        $_options->addOptions
        ([
                ['f', "filling", Getopt::REQUIRED_ARGUMENT, "Allows to set the amount of living cells on the field."]
        ]);
    }

    /**
     * Fill field
     * The board will be filled with the wished number of cells. The filling will be set via parameter.
     * @param Field $_field
     * @param Getopt $_options
     */
    public function fillField(Field &$_field, Getopt $_options)
    {
        $filling = intval($_options->getOption("filling"));

        if ($filling == 0)
        {
            $filling = 50;
        }

        for ($y = 0; $y < $_field->getHeight(); $y++)
        {
            for ($x = 0; $x < $_field->getWidth(); $x++)
            {
                if ($filling > rand(0, 99))
                {
                    $_field->setField($x, $y, 1);
                }
            }
        }
    }
}