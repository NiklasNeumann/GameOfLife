<?php

namespace GameOfLife\inputs;

use GameOfLife\Field;
use GameOfLife\outputs\Console;
use Ulrichsg\Getopt;

/**
 * Generates a field with a glider.
 * The glider's position can be set manually by using the "x" and "y" parameters.
 */
class Glider extends BaseInput
{
    /**
     * Add options.
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
     * Fill field.
     * A Glider will be placed at the wished position on the field. The X- and Y-coordinates will be set via parameter.
     * @param Field $_field
     * @param Console $_console
     * @param Getopt $_options
     */
    public function fillField(Field &$_field, Console &$_console, Getopt $_options)
    {
        $offsetX = floor($_field->width() / 2 - 1.5);
        $offsetY = floor($_field->height() / 2 - 1.5);

        if ($_options->getOption("x") != null)
        {
            $offsetX =intval($_options->getOption("x"));
        }
        if ($_options->getOption("y") != null)
        {
            $offsetY =intval($_options->getOption("y"));
        }

        $_field->setFieldValue(1+$offsetX,0+$offsetY,1);
        $_field->setFieldValue(2+$offsetX,1+$offsetY,1);
        $_field->setFieldValue(2+$offsetX,2+$offsetY,1);
        $_field->setFieldValue(0+$offsetX,2+$offsetY,1);
        $_field->setFieldValue(1+$offsetX,2+$offsetY,1);
    }
}
