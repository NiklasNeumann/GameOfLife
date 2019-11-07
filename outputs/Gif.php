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

    /**
     * Allows to add options to the variable $options in the gameoflife.php file.
     * @param Getopt $_options
     * @return mixed
     */
    public function addOptions(Getopt &$_options)
    {
    }

    /**
     * Starts the output.
     * @param Getopt $_options
     * @return mixed
     */
    public function startOutput(Getopt $_options)
    {
    }

    /**
     * Stores the current Field in a buffer.
     * @param Field $_field
     * @return void
     */
    public function outputField(Field $_field)
    {
        $with = $_field->width();
        $height = $_field->height();

        $image = imagecreate($with, $height);
        $backgroundColor = imagecolorallocate($image, 0, 0, 0);
        $cellColor = imagecolorallocate($image, 255, 255, 255);

        for ($y = 0; $y < $height; $y++)
        {
            for ($x = 0; $x < $with; $x++)
            {
                imagesetpixel($image, $x, $y, $_field->field($x, $y) ? $cellColor : $backgroundColor);
            }
        }

        $this->buffer[] = $image;
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