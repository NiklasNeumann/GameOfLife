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
    private $backgroundColor = [];
    private $cellColor = [];

    private $countPng = 0;
    private $scaleFactor = 1;

    /**
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     */
    public function addOptions(Getopt &$_options)
    {
        $_options->addOptions
        ([
            [null, "pngOutputSize", Getopt::REQUIRED_ARGUMENT, "Allows to costomize the size of the cells."],
            [null, "pngOutputCellColor", Getopt::NO_ARGUMENT, "Allows to costomize the color of the living cells."],
            [null, "pngOutputBackgroundColor", Getopt::NO_ARGUMENT, "Allows to costomize the background color."]
        ]);
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


        if ($_options->getOption("pngOutputSize"))
        {
            $this->scaleFactor = intval($_options->getOption("pngOutputSize"));
        }


        if ($_options->getOption("pngOutputCellColor"))
        {
            echo "To set the color, please enter the right RGB color-code for the color you want.\n";
            echo "----------------------------------------\n";
            $this->cellColor[] = intval(readline("Cell-Color Red: "));
            $this->cellColor[] = intval(readline("Cell-Color Green: "));
            $this->cellColor[] = intval(readline("Cell-Color Blue: "));
        }
        else
        {
            $this->cellColor = [255, 255, 255];
        }


        if ($_options->getOption("pngOutputBackgroundColor"))
        {
            echo "To set the color, please enter the right RGB color-code for the color you want.\n";
            echo "----------------------------------------\n";
            $this->backgroundColor[] = intval(readline("Background-Color Red: "));
            $this->backgroundColor[] = intval(readline("Background-Color Green: "));
            $this->backgroundColor[] = intval(readline("Background-Color Blue: "));
        }
        else
        {
            $this->backgroundColor = [0, 0, 0];
        }
    }

    /**
     * Outputs the field.
     * @param Field $_field
     */
    public function outputField(Field $_field)
    {
        $width = $_field->width();
        $height = $_field->height();

        $image = imagecreate($width, $height);
        $backgroundColor = imagecolorallocate($image, $this->backgroundColor[0], $this->backgroundColor[1], $this->backgroundColor[2]);
        $cellColor = imagecolorallocate($image, $this->cellColor[0], $this->cellColor[1], $this->cellColor[2]);

        for ($y = 0; $y < $height; $y++)
        {
            for ($x = 0; $x < $width; $x++)
            {
                imagesetpixel($image, $x, $y,$_field->field($x, $y) ? $cellColor : $backgroundColor);
            }
        }
        $image = imagescale($image, $width * $this->scaleFactor, $height * $this->scaleFactor, IMG_NEAREST_NEIGHBOUR);

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