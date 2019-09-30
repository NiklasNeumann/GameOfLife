<?php

namespace gameoflife;

/**
 * Create random-field
 * Sets x- and y-coordinates for the field and fills them with random 0s and 1s (dead and alive cells).
 * @package gameoflife
 */
class Random extends Field
{
    public function __construct($_width, $_height, $_maxSteps)
    {
        parent::__construct($_width, $_height, $_maxSteps);

        for ($y = 0; $y < $this->height; $y++)
        {
            for ($x = 0; $x < $this->width; $x++)
            {
                $this->field[$x][$y] = rand(0, 1);
            }
        }
    }
}