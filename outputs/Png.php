<?php

namespace GameOfLife\outputs;

use GameOfLife\Field;
use Ulrichsg\Getopt;

/**
 * Creates Png-output
 * Outputs multiple Pngs, consisting of one field per Png.
 * @package GameOfLife\outputs
 */
class Png extends BaseOutput
{
    private $countPng = 0;

    /**
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     */
    public function addOptions(Getopt &$_options)
    {

    }

    /**
     * Starts the output.
     * @param Getopt $_options
     */
    public function startOutput(Getopt $_options)
    {
        if (!is_dir("outPng"))
        {
            mkdir("outPng", 0755);
        }
    }

    /**
     * Outputs the field.
     * @param Field $_field
     */
    public function outputField(Field $_field)
    {
        $image = imagecreate($_field->width(), $_field->height());

        $backgroundColor = imagecolorallocate($image, 0,0,0);
        $cellColor = imagecolorallocate($image, 255, 255, 255);

        for ($y = 0; $y < $_field->height(); $y++)
        {
            for ($x = 0; $x < $_field->width(); $x++)
            {
                imagesetpixel($image, $x, $y,$_field->field($x, $y) ? $cellColor : $backgroundColor);
            }
        }

        imagepng($image,"outPng/" .  sprintf("%03d.png", $this->countPng));
        $this->countPng++;
    }

    /**
     * Finishes the output.
     */
    public function finishOutput()
    {

    }
}