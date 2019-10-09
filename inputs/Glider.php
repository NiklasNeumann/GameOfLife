<?php

namespace GameOfLife\inputs;

use GameOfLife\Field;
use Ulrichsg\Getopt;

class Glider extends BaseInput
{
    /**
     * Add options
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     */
    public function addOptions(Getopt &$_options)
    {
        $_options->addOptions(
            [
                ['x', "x", Getopt::REQUIRED_ARGUMENT, "Allows to set the x-position of the glider on the field."],
                ['y', "y", Getopt::REQUIRED_ARGUMENT, "Allows to set the y-position of the glider on the field."]
            ]);
    }

    /**
     * Fill field
     * A Glider will be placed at the wished position on the field. The X- and Y-coordinates will be set via parameter.
     * @param Field $_field
     * @param Getopt $_options
     */
    public function fillField(Field &$_field, Getopt $_options)
    {
        $offsetX = floor($_field->getWidth() / 2 - 1.5);
        $offsetY = floor($_field->getHeight() / 2 - 1.5);

        if ($_options->getOption("x") != null)
        {
            $offsetX =intval($_options->getOption("x"));
        }
        if ($_options->getOption("y") != null)
        {
            $offsetY =intval($_options->getOption("y"));
        }

        $_field->setField(1+$offsetX,0+$offsetY,1);
        $_field->setField(2+$offsetX,1+$offsetY,1);
        $_field->setField(2+$offsetX,2+$offsetY,1);
        $_field->setField(0+$offsetX,2+$offsetY,1);
        $_field->setField(1+$offsetX,2+$offsetY,1);
    }
}
