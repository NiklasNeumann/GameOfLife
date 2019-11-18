<?php

namespace GameOfLife\outputs;

require_once "AnimGif.php";

use GameOfLife\Field;
use GifCreator\AnimGif;
use Ulrichsg\Getopt;

/**
 * Saves the Field as a gif animation.
 *
 * use startOutput() to start the output,
 * outputField() saves the current field in a buffer and finishOutput() saves the buffered data to disc.
 * @package GameOfLife\outputs
 */
class Gif extends BaseOutput
{
    private $buffer = [];
    private $backgroundColor = [];
    private $cellColor = [];

    private $scaleFactor = 1;

    /**
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     * @return void
     */
    public function addOptions(Getopt $_options)
    {
        $_options->addOptions
        ([
            [null, "gifOutputSize", Getopt::REQUIRED_ARGUMENT, "Allows to costomize the size of the cells."],
            [null, "gifOutputCellColor", Getopt::NO_ARGUMENT, "Allows to costomize the color of the living cells."],
            [null, "gifOutputBackgroundColor", Getopt::NO_ARGUMENT, "Allows to costomize the background color."]
        ]);
    }

    /**
     * Starts the output.
     * @param Getopt $_options
     * @return void
     */
    public function startOutput(Getopt $_options)
    {
        if (!is_dir("outGif"))
        {
            mkdir("outGif", 0755);
        }


        if ($_options->getOption("gifOutputSize"))
        {
            $this->scaleFactor = intval($_options->getOption("gifOutputSize"));
        }


        if ($_options->getOption("gifOutputCellColor"))
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


        if ($_options->getOption("gifOutputBackgroundColor"))
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
     * Stores the current Field in a buffer.
     * @param Field $_field
     * @return void
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
                imagesetpixel($image, $x, $y, $_field->fieldValue($x, $y) ? $cellColor : $backgroundColor);
            }
        }

        $this->buffer[] = imagescale($image, $width * $this->scaleFactor, $height * $this->scaleFactor, IMG_NEAREST_NEIGHBOUR);
    }

    /**
     * Writes buffered data to disc.
     * @return void
     * @throws \Exception
     */
    public function finishOutput()
    {
        $anim = new AnimGif();
        try
        {
            $anim->create($this->buffer, 1);
            $anim->save("output.gif");
            $this->buffer = [];
        }
        catch (\Exception $e)
        {
            echo $e->getMessage();
        }

    }
}