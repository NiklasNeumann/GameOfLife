<?php

namespace GameOfLife\inputs;

use GameOfLife\Field;
use Ulrichsg\Getopt;

/**
 * Fills the board from user input.
 *
 * With the function addOptions, you can add Options from outside of the gameoflife.php file.
 * The function fillField can be used to fill the $field variable in Field.php with the wished field-stats.
 * @package GameOfLife\inputs
 */
class User extends BaseInput
{
    /**
     * Adds options.
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options Option manager to check for optional arguments.
     */
    public function addOptions(Getopt &$_options)
    {
    }

    /**
     * Fills a field.
     *
     * @param Field $_field Board to prepare.
     * @param Getopt $_options Option manager to check for optional arguments.
     */
    public function fillField(Field &$_field, Getopt $_options)
    {
        echo "To change a cell type the coordinates and optionally the state separated by commas";
        echo "and hit enter\n";
        echo "e.g. \"5,14,1\" creates a living cell at 5|14.\n";
        echo "If you are finished type exit\n";
        while(1)
        {
            $_field->printField();
            $line = readline("<<");
            if( $line == "exit" )
                break;
            $coords = explode(",", $line);
            if(count($coords) == 2)
            {
                $_field->setField($coords[0],$coords[1],1);
            }
            if(count($coords) == 3)
            {
                $_field->setField($coords[0],$coords[1],$coords[2]);
            }
        }
    }
}
