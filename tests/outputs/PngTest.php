<?php

namespace outputs;

use GameOfLife\Board;
use GameOfLife\outputs\Png;
use Icecave\Isolator\Isolator;
use PHPUnit\Framework\TestCase;
use Ulrichsg\Getopt;

class PngTest extends TestCase
{
    public function testOutputWithoutColors()
    {
        $field = new Board(5, 5);
        $field->setBoardValue(2, 2, 1);
        $option = new Getopt();
        $png = new Png();
        $png->startOutput($option);
        $png->outputBoard($field);

        $picture = imagecreatefrompng("outPng/000.png");

        $this->assertTrue($this->comparePicture($field, $picture));
    }

    public function testCellColor()
    {
        $field = new Board(5, 5);
        $field->setBoardValue(2, 2, 1);
        $option = new Getopt();
        $png = new Png();
        $png->addOptions($option);
        $option->parse("--pngOutputBackgroundColor");
        $isolator = $this->createMock(Isolator::class);
        $isolator->method("readline")
            ->willReturn("122")
            ->willReturn("122")
            ->willReturn("122");
        $png->setIsolator($isolator); //expectColor("122", "122", "122");
        $png->startOutput($option);
        $png->outputBoard($field);

        $picture = imagecreatefrompng("outPng/000.png");

        $this->assertTrue($this->comparePicture($field, $picture, ["red" => 255, "green" => 255, "blue" => 255, "alpha" => 0], ["red" => 122, "green" => 122, "blue" => 122, "alpha" => 0]));
    }

    public function testBackgroundColor()
    {
        $field = new Board(5, 5);
        $field->setBoardValue(2, 2, 1);
        $option = new Getopt();
        $png = new Png();
        $png->addOptions($option);
        $option->parse("--pngOutputCellColor");
        $isolator = $this->createMock(Isolator::class);
        $isolator->method("readline")
            ->willReturn("200")
            ->willReturn("200")
            ->willReturn("200");
        $png->setIsolator($isolator);
        $png->startOutput($option);
        $png->outputBoard($field);

        $picture = imagecreatefrompng("outPng/000.png");

        $this->assertTrue($this->comparePicture($field, $picture, ["red" => 200, "green" => 200, "blue" => 200, "alpha" => 0]));
    }

    public function testCellSizeBecauseKevinToldMeToDoSo()
    {
        $field = new Board(2, 2);
        $field->setBoardValue(0, 1, 1);
        $field->setBoardValue(1, 0, 1);
        $option = new Getopt();
        $png = new Png();
        $png->addOptions($option);
        $size = 4; //TODO: Resize only works with 2^x! Any other number won't work!
        $option->parse("--pngOutputSize " . $size);
        $png->startOutput($option);
        $png->outputBoard($field);

        $picture = imagecreatefrompng("outPng/000.png");
        $counter = 0;
        $previousColor = imagecolorat($picture, 0 , 0);



        for($y = 0; $y < $field->width() * $size; $y++)
        {
            if (imagecolorat($picture, 0 , $y) == $previousColor)
            {
                $counter++;
            }
            else
            {
                $this->assertEquals($size, $counter);
                break;
            }
        }
    }

    /**
     * Compare Picture
     * The function uses the given parameters to create a new picture.
     * Afterward this picture be compared to another generated picture and will give a positive Unit-test result, if both of them are equal.
     * @param Board $board
     * @param $picture resource
     * @param $cellColor array defines the color for the cell, by using RGB code.
     * @param $backgroundColor array defines the backgroundcolor of the cell, by using RGB code.
     * @return bool
     */
    private function comparePicture(Board $board, $picture,
                                    $cellColor = ["red" => 255, "green" => 255, "blue" => 255, "alpha" => 0],
                                    $backgroundColor = ["red" => 0, "green" => 0, "blue" => 0, "alpha" => 0]): bool
    {
        $isEqual = true;
        for ($y = 0; $y < $board->height(); $y++)
        {
            for ($x = 0; $x < $board->width(); $x++)
            {
                $pxlColor = imagecolorat($picture, $x, $y);
                $color = imagecolorsforindex($picture, $pxlColor);

                if ($board->boardValue($x, $y) == true)
                {
                    if ($color != $cellColor)
                    {
                        $isEqual = false;
                    }
                }
                else
                {
                    if ($color != $backgroundColor)
                    {
                        $isEqual = false;
                    }
                }
            }
        }
        return $isEqual;
    }
}