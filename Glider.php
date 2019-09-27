<?php

namespace gameoflife;

/**
 * Class Glider
 * Sets the needed coordinates for the glider and does not change the rest of the field (stays 0).
 * @package gameoflife
 */
class Glider extends Field
{
    public function __construct($_width, $_height, $_maxSteps)
    {
        parent::__construct($_width, $_height, $_maxSteps);

        $this->field[1][0] = 1;
        $this->field[2][1] = 1;
        $this->field[2][2] = 1;
        $this->field[0][2] = 1;
        $this->field[1][2] = 1;
    }
}