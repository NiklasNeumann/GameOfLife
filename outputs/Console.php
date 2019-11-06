<?php

namespace GameOfLife\outputs;

use GameOfLife\Field;
use Ulrichsg\Getopt;


class Console extends BaseOutput
{
    public function addOptions(Getopt &$_options)
    {

    }
    
    public function startOutput(Getopt $_options)
    {

    }

    public function outputField(Field $_field)
    {
        $_field->printField();
    }

    public function finishOutput()
    {

    }
}