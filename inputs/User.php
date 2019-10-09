<?php

namespace GameOfLife\inputs;

use GameOfLife\Field;
use Ulrichsg\Getopt;

class User extends BaseInput
{
    /**
     * Add options
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     */
    public function addOptions(Getopt &$_options)
    {
    }

    /**
     * Fills field
     *
     * @param Field $_field Field to fill.
     * @param Getopt $_options
     */
    public function fillField(Field &$_field, Getopt $_options)
    {
        echo "To change the state of a cell type in the coordinates of the cell separated by a comma.\n";
        echo "Additionally the state can be added.";
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
