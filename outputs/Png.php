<?php

namespace GameOfLife\outputs;

use GameOfLife\Field;
use Ulrichsg\Getopt;

class Png extends BaseOutput
{
    private $countPng = 0;

    public function addOptions(Getopt &$_options)
    {

    }

    public function startOutput(Getopt $_options)
    {
        if (!is_dir("outPng"))
        {
            mkdir("outPng", 0755);
        }
    }

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

    public function finishOutput()
    {

    }
}