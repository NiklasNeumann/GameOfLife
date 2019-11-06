<?php

namespace GameOfLife\outputs;

use GameOfLife\Field;
use Ulrichsg\Getopt;

abstract class BaseOutput
{
    abstract public function addOptions(Getopt &$_options);

    abstract public function startOutput(Getopt $_options);

    abstract public function outputField(Field $_field);

    abstract public function finishOutput();
}